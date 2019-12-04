<?php


namespace model;


class Routes
{
    private $id;
    private $route;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    public static function getAllRoutes(){
        $query = new Query();
        $query->setQuery('
                SELECT DISTINCT R.route_id,
                CONCAT(R.route_short_name," - ",R.route_long_name) as route
                FROM ROUTES R
                ');
        $query->execQuery();

        return $query->getResults();
    }

    public static function getStopsByID($id){
        $query = new Query();
        $query->setQuery('
                SELECT S.stop_name as stops
                FROM STOP_TIMES ST
                    INNER JOIN STOPS S using(stop_id)
                    INNER JOIN TRIPS T using(trip_id)
                    INNER JOIN ROUTES R using(route_id)
                WHERE R.route_id = :ID
                GROUP BY S.stop_name,ST.stop_sequence
                ',[
                    ":ID"=>$id
        ]);
        $query->execQuery();

        return $query->getResults();
    }

    public function createRoute(){
        $query = new Query();
        $query->setQuery("
                INSERT INTO ROUTES (route_id,agency_id,route_short_name,route_long_name)
                VALUES (:ROUTEID,'EPTC',:ROUTEID,:ROUTELONGNAME)",
            array(
                ":ROUTEID"=>$this->getId(),
                ":ROUTELONGNAME"=>$this->getRoute()
            )
        );
        $query->execQuery();
    }

    public function updateRoute($oldRoute){
        $query = new Query();
        $query->setQuery("
                UPDATE ROUTES SET
                route_short_name = :ROUTEID,
                route_long_name = :ROUTELONGNAME,
                route_id = :ROUTEID
                WHERE route_id = :OLDROUTE
                ",
            array(
                ":ROUTEID"=>$this->getId(),
                ":ROUTELONGNAME"=>$this->getRoute(),
                ":OLDROUTE"=>$oldRoute
            )
        );
        $query->execQuery();
    }
}