<?php
trait Pagination
{
    # Total items of the tadabase results
    protected static $totalRows = null;

    # Max number of items you want shown per page
    protected static $perPage = null;

    # Result of the calculate of the total number of page
    protected static $numPage = null;

    # Items from database
    protected static $query = null;

    protected static $nextLink = null;

    protected static $afterLink = null;

    # Calculate the total of the rows
    private static function totalRows()
    {
        self::$totalRows = count(self::$query);
        return self::$totalRows;
    }

    /**
    * Make the pagination
    *
    * @param per_page : int : Number of items per page
    * @param db_query : array : Query from database
    * @return Array of the object
    */

    public static function paginator($perPage, $dbQuery)
    {
        if (isset($_GET['p'])) {
            # Get the value from HTTP-GET
            $getPage = (int) $_GET['p'];
        }

        if (empty($getPage)) {
            $getPage = 1;
        }

        self::$query = $dbQuery;

        # Array separator
        $result = array_chunk($dbQuery, $perPage);
        self::$numPage = count($result);

        # Result of items
        return $result[$getPage -1];
    }

    # Create of the nex link of pagination
    public static function next_link()
    {
        if (isset($_GET['p'])) {
            # Get the value from HTTP-GET
            $getPage = (int) $_GET['p'];
        }

        if (empty($getPage)) {
            $getPage = 1;
        }

        if (isset($getPage)) {
            self::$nextLink = $getPage + 1;
        }

        $next = self::$nextLink;

        if ($next > self::$numPage) {
            $next = self::$numPage;
        }

        $controller = Get_url::getUrl('controller');
        $method = Get_url::getUrl('method');

        $url = null;

        if ( ! isset($_GET['p'])) {
            $url = "?{$controller}={$method}&p={$next}";
        } else {
            $url = "?{$controller}={$method}={$next}";
        }

        echo "href='{$url}'>";
    }

    # Create of the after link of pagination
    public static function afterLink()
    {
        if (isset($_GET['p'])) {
            # Get the value from HTTP-GET
            $getPage = (int) $_GET['p'];
        }

        if (empty($getPage)) {
            $getPage = 1;
        }

        if (isset($getPage)) {
            self::$nextLink = $getPage + 1;
        }

        $after = self::$afterLink;
        $min = $getPage - 1;

        if ($min < 1) {
            $min = 1;
        }

        $controller = GetURL::getURL('controller');
        $method = GetURL::getURL('method');

        $url = "?{$controller}={$method}={$min}";
        echo "href='{$url}'>";
    }

    public static function paginateInformation()
    {
        $page = $_GET['p'];
        if ($page >= self::$numPage) {
            $page = self::$numPage;
        }

        return $page . " de " . self::$numPage;
    }
}
