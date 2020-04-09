
import axios from 'axios'
import isNil from 'lodash.isnil'

Vue.mixin({
	methods: {
		isNil: isNil,
	}
})

Vue.component('card', {
	props: ['fields'],
	template: `
		<div class="wrapper card">
			<a :href="fields.link">
				<div class="card__thumb" :style="{ backgroundImage: 'url('+ fields.thumb_url +')' }"></div>
				<div class="card__meta">
					<p class="card__date">{{ fields.date }}</p>
				</div>
				<h5 class="card__title">{{ fields.title }}</h5>
				<span class="link btn">Read More</span>
			</a>
		</div>
	`
})

Vue.component('image-bg', {
	props: ['fields'],
	template: `
		<div class="wrapper image-bg">
			<a :href="fields.link" :style="{ 'background-image': 'url('+ fields.thumb_url +')' }">
				<h5 class="image-bg__title">{{ fields.title }}</h5>
			</a>
		</div>
	`
})

new Vue({
	el: '#blog',
	data: {
		admin_ajax: '',
		query: {},
		filters: {},
		content: {},
		appearance: '',
		posts: [],
		totalPosts: -1,
		loading: false,
		initialized: false,
		error: false,
		filterBy: {},
		user_filters: {}
	},
	created () {

		// Get blog settings from the wp template
		this.admin_ajax = window.blog.admin_ajax
		this.query = window.blog.query
		this.filters = window.blog.filters
		this.content = window.blog.content
		this.appearance = window.blog.appearance

		// Generate user filters model
		if (this.filters) {
			this.filters.forEach((filter, i) => {
				Vue.set(
					this.user_filters, 
					filter.taxonomy.name,
					filter.filter_type === 'checkbox' || filter.filter_type === 'checkbox_fancy' ? [] : 'all'
				)
			}, this)
		} else {
			this.initialized = true
			this.init()
		}
	},
	watch: {
		user_filters: {
			handler: function(filters) {
				// This will initiate the first axios call, too
				if (this.initialized && this.filters.length > 1) {
					return
				} else {
					this.initialized = true
					this.init()
				}
			},
			deep: true
		}
	},
	template: `
	<div class="container">

		<div class="filters">
			<form @submit="filterPosts" :class="{ disabled: loading }">
				<div v-for="filter in filters" :id="filter.taxonomy.name" class="filter" :class="filter.filter_type">
					<h5 v-if="filter.heading.length">{{ filter.heading }}</h5>
					<div v-if="filter.filter_type === 'dropdown'">
					<div class="chosen-wrapper">
						<select
							:name="filter.taxonomy.name"
							v-model="user_filters[filter.taxonomy.name]">
							<option selected value="all">All</option>
							<option
								v-for="term in filter.taxonomy.terms"
								:value="term.slug">{{ term.name }}</option>
						</select>
					</div>
					<div v-if="filter.filter_type === 'radio'">
						<span>
							<input
								:id="filter.taxonomy.name+'-all'"
								type="radio" :name="filter.taxonomy.name"
								value="all"
								v-model="user_filters[filter.taxonomy.name]">
							<label :for="filter.taxonomy.name+'-all'"><span>All</span></label>
						</span>
						<span v-for="term in filter.taxonomy.terms">
							<input
								:id="term.slug"
								type="radio" :name="filter.taxonomy.name"
								:value="term.slug"
								v-model="user_filters[filter.taxonomy.name]">
							<label :for="term.slug"><span>{{ term.name }}</span></label>
						</span>
					</div>
					<div v-if="filter.filter_type === 'radio_fancy'">
						<span>
							<input
								class="fancy"
								:id="filter.taxonomy.name+'-all'"
								type="radio" :name="filter.taxonomy.name"
								value="all"
								v-model="user_filters[filter.taxonomy.name]">
							<label :for="filter.taxonomy.name+'-all'"><span>All</span></label>
						</span>
						<span v-for="term in filter.taxonomy.terms">
							<input
								class="fancy"
								:id="term.slug"
								type="radio" :name="filter.taxonomy.name"
								:value="term.slug"
								v-model="user_filters[filter.taxonomy.name]">
							<label :for="term.slug"><span>{{ term.name }}</span></label>
						</span>
					</div>
					<div v-if="filter.filter_type === 'checkbox'">
						<span v-for="term in filter.taxonomy.terms">
							<input
								:id="term.slug"
								type="checkbox" :name="filter.taxonomy.name"
								:value="term.slug"
								v-model="user_filters[filter.taxonomy.name]">
							<label :for="term.slug"><span>{{ term.name }}</span></label>
						</span>
					</div>
					<div v-if="filter.filter_type === 'checkbox_fancy'">
						<span v-for="term in filter.taxonomy.terms">
							<input
								class="fancy"
								:id="term.slug"
								type="checkbox" :name="filter.taxonomy.name"
								:value="term.slug"
								v-model="user_filters[filter.taxonomy.name]">
							<label :for="term.slug"><span>{{ term.name }}</span></label>
						</span>
					</div>
				</div>
				<div v-if="filters.length > 1" class="footer">
					<button class="btn m-0">{{ content.filter_button_text }}</button>
				</div>
			</form>
		</div>

		<ul class="list" :class="appearance.list_item_layout">
			<li v-for="post in posts">
				<card v-if="appearance.list_item_style === 'card'"
					:fields="post"></card>
				<image-bg v-if="appearance.list_item_style === 'image_bg'"
					:fields="post"></image-bg>
			</li>
		</ul>

		<div class="pagination">
			<div class="load-more" v-if="totalPosts > posts.length && !loading">
				<a class="btn" href="#load-more" @click="loadMore">{{ content.load_more_text }}</a>
			</div>
			<div class="all-loaded" v-if="totalPosts === posts.length && posts.length > 0 && !loading">
				<span>{{ content.all_loaded_text }}</span>
			</div>
			<div class="none-found" v-if="totalPosts === 0 && !loading">
				<span>{{ content.none_found_text }}</span>
			</div>
			<div class="error" v-if="error && !loading">
				<span>{{ content.error_text }}</span>
			</div>
			<div class="loading" v-if="loading">
				<span><svg aria-hidden="true" data-prefix="fas" data-icon="spinner" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"></path></svg></span>
			</div>
		</div>

	</div>
	`,
	methods: {

		fixAmp (array) {

			let cleanArray = []
			array.forEach(item => {
				item.title = item.title.split(/&#038;/).join('&')
				item.excerpt = item.excerpt.split(/&#038;/).join('&')
				cleanArray.concat(item)
			})
			return cleanArray

		},

		init () {

			this.query.paged = 1
			this.posts = []
			this.getBatch()

		},

		filterPosts (e) {

			e.preventDefault()
			this.query.paged = 1
			this.posts = []
			this.getBatch()

		},

		loadMore (e) {

			if (!isNil(e)) {
				e.preventDefault()
			}
			this.query.paged++
			this.getBatch()

		},

		getBatch () {

			if (!this.loading) {
				this.loading = true
				axios.post(this.admin_ajax, {
					query: this.query,
					user_filters: this.user_filters
				})
				.then(response => {

					this.totalPosts = response.data.total_posts
					this.fixAmp(response.data.posts)
					this.posts = this.posts.concat(response.data.posts)
					this.loading = false
				})
				.catch(error => {

				})
			}

		},
		
	}
});
