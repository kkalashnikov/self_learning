<?php

namespace Routes;

/**
 * First, let's define our Routes object.
 */
class Router {

  /**
   * The request we're working with.
   *
   * @var string
   */
  public $request;

  /**
   * The $routes array will contain our URI's and callbacks.
   *
   * @var array
   */
  public $routes = [];

  /**
   * For this example, the constructor will be responsible
   * for parsing the request.
   *
   * @param array $request
   */
  public function __construct(array $request) {

    $path = explode('?', basename($request['REQUEST_URI']));
    $this->request = $path[0];
  }

  /**
   * Add a route and callback to our $routes array.
   *
   * @param string $uri
   * @param Callable $function
   */
  public function addRoute(string $uri, \Closure $function): void {
    $this->routes[$uri] = $function;
  }

  /**
   * Determine is the requested route exists in our
   * routes array.
   *
   * @param string $uri
   *
   * @return boolean
   */
  public function hasRoute(string $uri): bool {
    return array_key_exists($uri, $this->routes);
  }

  /**
   * Run the router.
   *
   * @return mixed
   */
  private function run() {
    if ($this->hasRoute($this->request)) {
      $this->routes[$this->request]->call($this);
    }
  }

  /**
   * Prepare routing.
   *
   * @param array $routes
   *   Routes array
   */
  public function prepareRoutes($routes) {
    foreach ($routes as $key => $route) {
      $this->addRoute($key, function () use ($route) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/' . $route;
      });
    }

    $this->run();
  }

}

?>