<?php
class Rest
{
  private $_contentType = "application/json; charset=utf-8";
  protected $_prettyPrint = false; //true = pretty JSON printing
  protected $_request = array();
  protected $_method = "";
  private $_code = 200;

  protected function __constructor()
  {
    $this->inputs();
  }

  protected function response($data, $status)
  {
    $this->_code = ($status) ? $status : 200;
    $this->setHeaders();
    echo $data;
    exit;
  }

  private function inputs()
  {
    switch ($_SERVER['REQUEST_METHOD']) { // Make switch case so we can add additional
      case "GET":
        $this->_request = $this->cleanInputs($_REQUEST); //or $_GET
        $this->_method = "GET";
        //$this->logRequest();
        break;
      case "POST":
        $this->_request = $this->cleanInputs($_REQUEST); //or $_GET
        $this->_method = "POST";
        //$this->logRequest();
        break;
      case "PUT":
        $this->_request = $this->cleanInputs($_REQUEST); //or $_GET
        $this->_method = "PUT";
        //$this->logRequest();
        break;
      case "DELETE":
        $this->_request = $this->cleanInputs($_REQUEST); //or $_GET
        $this->_method = "DELETE";
        //$this->logRequest();
        break;
      default:
        $this->response('Forbidden', 403);
        break;
    }
  }

  private function cleanInputs($data)
  {
    $clean_input = array();
    if (is_array($data)) {
      foreach ($data as $k => $v) {
        $clean_input[$k] = $this->cleanInputs($v);
      }
    } else {
      if (get_magic_quotes_gpc()) {
        // Returns 0 if magic_quotes_gpc is off,
        // 1 otherwise. Always returns FALSE as of PHP 5.4
        $data = trim(stripslashes($data));
      }
      $data = strip_tags($data);
      $clean_input = trim($data);
    }
    return $clean_input;
  }

  private function setHeaders()
  {
    header("HTTP/1.1 " . $this->_code . " " . $this->getStatusMessage());
    header("Content-Type:" . $this->_contentType);
  }

  private function getStatusMessage()
  {
    $status = array(
      100 => 'Continue',
      101 => 'Switching Protocols',
      200 => 'OK',
      201 => 'Created',
      202 => 'Accepted',
      203 => 'Non-Authoritative Information',
      204 => 'No Content',
      205 => 'Reset Content',
      206 => 'Partial Content',
      300 => 'Multiple Choices',
      301 => 'Moved Permanently',
      302 => 'Found',
      303 => 'See Other',
      304 => 'Not Modified',
      305 => 'Use Proxy',
      306 => '(Unused)',
      307 => 'Temporary Redirect',
      400 => 'Bad Request',
      401 => 'Unauthorized',
      402 => 'Payment Required',
      403 => 'Forbidden',
      404 => 'Not Found',
      405 => 'Method Not Allowed',
      406 => 'Not Acceptable',
      407 => 'Proxy Authentication Required',
      408 => 'Request Timeout',
      409 => 'Conflict',
      410 => 'Gone',
      411 => 'Length Required',
      412 => 'Precondition Failed',
      413 => 'Request Entity Too Large',
      414 => 'Request-URI Too Long',
      415 => 'Unsupported Media Type',
      416 => 'Requested Range Not Satisfiable',
      417 => 'Expectation Failed',
      500 => 'Internal Server Error',
      501 => 'Not Implemented',
      502 => 'Bad Gateway',
      503 => 'Service Unavailable',
      504 => 'Gateway Timeout',
      505 => 'HTTP Version Not Supported'
    );
    return ($status[$this->_code]) ? $status[$this->_code] : $status[500];
  }

  protected function json($data)
  {
    if (is_array($data)) {
      // if ($this->_prettyPrint === true) {
      //     return $this->prettyJSON(json_encode($data));
      // }
      //Pretty?
      // else {
      return json_encode($data);
      // }

    }
  }
}
