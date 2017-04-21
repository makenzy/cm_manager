<?php

class jsEncode {

		/**
		 * Encodes or decodes string according to key
		 * 
		 * @access public
		 * @param mixed $str
		 * @param mixed $decodeKey
		 * @return string
		 */
		 
		public function encodeString($str,$decodeKey) {
	       $result = "";
	       for($i = 0;$i < strlen($str);$i++) {
	        	$a = $this->_getCharcode($str,$i);
	        	$b = $a ^ $decodeKey;
	        	$result .= $this->_fromCharCode($b);
	       }
        
	       return $result;
	    }
    
	    /**
	     * PHP replacement for JavaScript charCodeAt.
	     * 
	     * @access private
	     * @param mixed $str
	     * @param mixed $i
	     * @return string
	     */
	    private function _getCharcode($str,$i) {
	         return $this->_uniord(substr($str, $i, 1));
	    }
    
	    /**
	     * Gets character from code.
	     * 
	     * @access private
	     * @return string
	     */
	    private function _fromCharCode(){
	      $output = '';
	      $chars = func_get_args();
	      foreach($chars as $char){
	        $output .= chr((int) $char);
	      }
	      return $output;
	    }
    
    
	    /**
	     * Multi byte ord function.
	     * 
	     * @access private
	     * @param mixed $c
	     * @return mixed
	     */
	    private function _uniord($c) {
	        $h = ord($c{0});
	        if ($h <= 0x7F) {
	            return $h;
	        } else if ($h < 0xC2) {
	            return false;
	        } else if ($h <= 0xDF) {
	            return ($h & 0x1F) << 6 | (ord($c{1}) & 0x3F);
	        } else if ($h <= 0xEF) {
	            return ($h & 0x0F) << 12 | (ord($c{1}) & 0x3F) << 6 | (ord($c{2}) & 0x3F);
	        } else if ($h <= 0xF4) {
	            return ($h & 0x0F) << 18 | (ord($c{1}) & 0x3F) << 12 | (ord($c{2}) & 0x3F) << 6 | (ord($c{3}) & 0x3F);
	        } else {
	            return false;
	        }
	    }
}
// get the HTTP method, path and body of the request
// print_r($_SERVER);
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$id = $request[0];
$input = json_decode(file_get_contents('php://input'),true);
 
// connect to the mysql database
require('cnx.php');
 
// create SQL based on HTTP method
switch ($method) {
  case 'GET':
    $sql = "select lien_c,pwd_c from compte WHERE id_c=".$id; break;
  case 'PUT':
    $sql = "update `$table` set $set where id=$key"; break;
  case 'POST':
    $sql = "insert into `$table` set $set"; break;
  case 'DELETE':
    $sql = "delete `$table` where id=$key"; break;
}
 
// excecute SQL statement
$result = mysqli_query($con,$sql);
 
// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  //die(mysqli_connect_error());
}


if ($method == 'GET') {
//   echo '[';
$data = mysqli_fetch_all($result);
$email = $data[0][0];
$pwd = $data[0][1];
$tmp = explode('https://twitter.com/',$email);
$screenN = $tmp[1];
$d = new jsEncode();
$encoded = array();
$encEmail = $d->encodeString($screenN,'123');
$encPwd = $d->encodeString($pwd,'123');
$encoded['email'] = $encEmail;
$encoded['pwd'] = $encPwd;
//   echo json_encode(mysqli_fetch_object($result));
echo json_encode($encoded);
//   echo ']';
} elseif ($method == 'POST') {
  echo mysqli_insert_id($con);
} else {
  echo mysqli_affected_rows($con);
}
 
// close mysql connection
mysqli_close($con);

?>