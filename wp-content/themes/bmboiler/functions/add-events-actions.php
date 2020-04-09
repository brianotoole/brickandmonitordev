<?php 
// Event Calendar Pro Actions
/**
 * Allows visitors to page forward/backwards in any direction within month view
 * an "infinite" number of times (ie, outwith the populated range of months).
 */
if ( class_exists( 'Tribe__Events__Main' ) ) {
	class ContinualMonthViewPagination {
	    public function __construct() {
	        add_filter( 'tribe_events_the_next_month_link', array( $this, 'next_month' ) );
	        add_filter( 'tribe_events_the_previous_month_link', array( $this, 'previous_month' ) );
	    }
	    public function next_month() {
	        $url = tribe_get_next_month_link();
	        $text = tribe_get_next_month_text();
	        $date = Tribe__Events__Main::instance()->nextMonth( tribe_get_month_view_date() );
	        return '<a data-month="' . $date . '" href="' . $url . '" rel="next">' . $text . ' <span>&raquo;</span></a>';
	    }
	    public function previous_month() {
	        $url = tribe_get_previous_month_link();
	        $text = tribe_get_previous_month_text();
	        $date = Tribe__Events__Main::instance()->previousMonth( tribe_get_month_view_date() );
	        return '<a data-month="' . $date . '" href="' . $url . '" rel="prev"><span>&laquo;</span> ' . $text . ' </a>';
	    }
	}
	new ContinualMonthViewPagination;
}

?>