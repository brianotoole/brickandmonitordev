
class Blog {

	constructor (container) {

		this.container = container;
		
		try {
			this.testSettings();
		} catch (e) {
			console.log('%c'+e, 'color: red;');
		}

		this.mergeSettings(this, $(this.container).data());

		this.query.action = 'blog_load_more';
		this.query.list_item_style = this.appearance.list_item_style;

		this.cleanupData();
		this.loadMore();
		this.initEvents();

	}

	mergeSettings (targetObj, newObj) {

	    for (var p in newObj) {
	        try {
	            targetObj[p] = newObj[p].constructor==Object ? mergeSettings(targetObj[p], newObj[p]) : newObj[p];
	        } catch(e) {
	            targetObj[p] = newObj[p];
	        }
	    }

	    return targetObj;
	}

	testSettings () {

		if (typeof this.container == 'undefined') {
			throw 'Blog class requires a blog container class or id to be sent to the constructor';
		}

	}

	cleanupData () {

		$(this.container).removeData();
		$(this.container)
			.removeAttr('data-admin_ajax')
			.removeAttr('data-query')
			.removeAttr('data-elements');

	}

	initEvents () {

		var temp_this = this;

		// Load More
		$(this.elements.load_more).find('button, a').on('click', function(e) {

			e.preventDefault();

			temp_this.hideElems();
			$(temp_this.elements.loading).show();
			temp_this.loadMore();

		});

		// Filter
		$(this.elements.filter_form).find('input, select').on('change', function(e) {

			e.preventDefault();

			temp_this.updateTaxQuery($(temp_this.elements.filter_form).toArray()[0]);
			temp_this.reset();
			temp_this.loadMore();

		});

		// $(this.elements.filter_form).submit(function(e) {

		// 	e.preventDefault();

		// 	temp_this.updateTaxQuery($(this).toArray()[0]);
		// 	temp_this.reset();
		// 	temp_this.loadMore();

		// });

	}

	hideElems () {

		$(this.elements.pagination).find('> div').hide();

	}

	reset () {

		/*
		*	Clear page number, lists, notifications, and displays the loading animation
		*/

		this.query.paged = 0;
		$(this.elements.list).html('');
		$(this.elements.pagination).find('> div').hide();
		$(this.elements.loading).show();

	}

	updateTaxQuery (formData) {

		var taxonomies = {};
		$.each(formData, function(i, field) {

			if (typeof field.value != 'undefined') {

				if (field.value.length > 0) {

					if (field.type == 'select-one' || field.checked) {

						if (typeof taxonomies[field.name] == 'undefined') {
							taxonomies[field.name] = new Array();
						}
						taxonomies[field.name].push(field.value);

					}
				}

			}

		});

		if (Object.keys(taxonomies).length) {

			for (var tax in taxonomies) {

				this.query.tax_query = new Array({taxonomy: tax, field: 'id', terms: taxonomies[tax]});

			}

			return true;

		} else {

			delete this.query.tax_query;

			return false;

		}

	}

	loadMore () {

		this.query.paged++;
		var temp_this = this;

		console.log(this.query);

		$.ajax({
			url: temp_this.admin_ajax,
			type: 'POST',
			data: temp_this.query,
			success: function(res) {

				$(temp_this.elements.list).append(res);

				$(temp_this.elements.pagination).find('> div').hide();

				if ($(temp_this.elements.list).find('> li').length < 1) {
					$(temp_this.elements.none_found).show();
				} else if ($(temp_this.elements.list).find('> li').length >= total_posts) {
					$(temp_this.elements.all_loaded).show();
				}else {
					$(temp_this.elements.load_more).show();
				}
			},
			error: function(res) {


			}
		});

	}

}

export default Blog;
