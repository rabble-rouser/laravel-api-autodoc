<?php

namespace RabbleRouser\ApiAutoDoc\Http\Controllers;

class DocumentationController
{
    public function index()
    {
        global $app;
        $routeCollection = $app->getRoutes();

        $documentableActions = array();
        foreach ($routeCollection as $route) {

            $action = $route['action'];
            // Only render the routes that have a 'docCategory'.
            if(is_array($action) && array_key_exists('docCategory', $action))
            {
                $route['unique_id']     = $this->createUniqueIDForRouteActionWithMethod($action, $route['method']);
                $route['parameters']    = $this->extractParametersFromURI($route['uri']);
                $documentableActions[$action['docCategory']][] = $route;
            }

        }

        return view('api-autodoc::docs.generated', ['documentableActions' => $documentableActions]);
    }

    /**
     * @param   string  $uri
     * @return  array
     */
    private function extractParametersFromURI($uri)
    {
        $parameters = array();

        // Extract all content between "{}" in the uri.
        // The results will be the uri's parameters.
        preg_match_all('/{(.*?)}/', $uri, $parameters);

        // Return the parameters at index "1". These
        // are strings without the "{}" wrappers.
        return $parameters[1];
    }

    private function createUniqueIDForRouteActionWithMethod($action, $method)
    {
        // Parse the end of the 'uses' string. This gives us the name of
        // the method on the controller that our endpoint directs to.
        $use = substr($action['uses'], strpos($action['uses'], "@") + 1);

        $unique_id = $method . $use . $action['docCategory'];

        return $unique_id;
    }
}
