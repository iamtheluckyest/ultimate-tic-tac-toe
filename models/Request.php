<?php
    class Request {
        public $url_elements;
        public $verb;
        public $parameters;
    
        public function __construct() {
            // Get GET, POST, PUT, DELETE verb
            $this->verb = $_SERVER['REQUEST_METHOD'];
            // URL path split into an array of pieces
            $this->url_elements = explode('/', $_SERVER['PATH_INFO']);    
            // 
            $this->parseIncomingParams();
            // initialise json as default format
            $this->format = 'json';
            // HOW CAN YOU HAVE A FORMAT ON YOUR PARAMETERS? AREN'T THEY JUST STRINGS?
            if(isset($this->parameters['format'])) {
                $this->format = $this->parameters['format'];
            }
            return true;
        }
    
        public function parseIncomingParams() {
            $parameters = array();
    
            // first of all, pull the GET vars
            if (isset($_SERVER['QUERY_STRING'])) {
                // Turns $_SERVER['QUERY_STRING'] into an array and puts it in $parameters
                parse_str($_SERVER['QUERY_STRING'], $parameters);
            }
            
            /* The php://input is the incoming stream to PHP. 
            For a "normal" web application we usually just use $_POST, which has already parsed this stream 
            and decoded the form fields that were sent with the request. 
            For handling JSON data, PUT requests, and anything else that isn't a form POST, we need to 
            parse the stream itself as shown here. */
            
            // now how about PUT/POST bodies? These override what we got from GET
            $body = file_get_contents("php://input");
            $content_type = false;
            if(isset($_SERVER['CONTENT_TYPE'])) {
                $content_type = $_SERVER['CONTENT_TYPE'];
            }
            if ($content_type === "application/json") {
                    $body_params = json_decode($body);
                    if($body_params) {
                        // Copying $body_params into $parameters -> this is the part that overrides what we got above
                        foreach($body_params as $param_name => $param_value) {
                            $parameters[$param_name] = $param_value;
                        }
                    }
                    $this->format = "json";
            }
            $this->parameters = $parameters;
        }
        
    }
?>