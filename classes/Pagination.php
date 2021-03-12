<?php

/**
 * Paginator
 *
 * Data for selecting a page of records
 */
class Pagination
{
    public $limit; // number of records to return
    public $offset; // number of records to skip  before page
    public $previous; // Previous page number
    public $next; // Next page number

    /**
     * Constructor
     *
     * @param integer $page Page number
     * @param integer $records_per_page Number of records per page
     * @param integer $total Total number of records
     *
     * @return void
     */
    public function __construct($page, $records_per_page, $total_records)
    {
        $this->limit = $records_per_page;
        // get current page value from the url.
        $page = filter_var($page, FILTER_VALIDATE_INT, [
            'options' => [
                'default' => 1, // if value is not an integer
                'min_range' => 1, //minimum value to be accepted.
            ],
        ]);

        // we set the previous page number
        if ($page > 1) {
            $this->previous = $page - 1;
        }

        // calculate the number of pages
        $total_pages = ceil($total_records / $records_per_page);

        // we set the next page number
        if ($page < $total_pages) {
            $this->next = $page + 1;
        }
        // we calculate the current offset relative to the page current value
        $this->offset = $records_per_page * ($page - 1);
    }
}
