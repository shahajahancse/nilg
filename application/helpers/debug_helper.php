<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Debug Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Yura Loginov
 * @link		https://github.com/yuraloginoff/codeigniter-debug-helper.git
 */

// ------------------------------------------------------------------------

/**
 * Readable print_r
 *
 * Prints human-readable information about a variable
 *
 * @access	public
 * @param	mixed 
 */
if ( ! function_exists('printr'))
{
	function ddd(...$vars)
		{
			$CI =& get_instance();
			// echo'<script src="'.base_url('sty.js').'"></script>';
			echo' <link rel="stylesheet" href="'.base_url('styc.css').'">';

			echo `<div>`;
		  foreach ($vars as $var) {
			$uniq_id = bin2hex(openssl_random_pseudo_bytes(4));
            if (is_array($var)) {
                $count_data = count($var);
                echo "<pre class='sf-dump' id='sf-dump-$uniq_id' data-indent-pad='  '>";
                echo "<span class='sf-dump-note'>array:$count_data</span> [";
                foreach ($var as $key => $value) {
                    echo `<samp data-depth='1' class='sf-dump-compact'>`;
                    echo "<span class='sf-dump-index'>$key</span> => <span class='sf-dump-note'>array:" . count($value) . "</span> [";
                    foreach ($value as $sub_key => $sub_value) {
                        echo "<br><span data-depth='2'";
                        echo "<span class='sf-dump-key'>$sub_key</span>=> ";
                        echo "\"<span class='sf-dump-str'>$sub_value</span>\"";
                        echo "</span>";
                    }
                    echo "]<br><br></samp>";
                }
                echo " ]</pre>";
                echo "<script>Sfdump('sf-dump-$uniq_id');</script>";
            }else{
                echo "<pre class='sf-dump' id='sf-dump-$uniq_id' data-indent-pad='  '>";
				print_r($var);
                echo "</pre>";
                echo "<script>Sfdump('sf-dump-$uniq_id');</script>";
			}
        }
			exit;
		}

	
}

// ------------------------------------------------------------------------

/**
 * Readable var_dump
 *
 * Readable dump information about a variable
 *
 * @access	public
 * @param	mixed * 
 */
if ( ! function_exists('vardump'))
{
	function vardump($var)
	{
		$CI =& get_instance();
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}

if ( ! function_exists('dd'))   
{
	function dd(...$var)
	{
		$CI =& get_instance();
        foreach($var as $key => $value){
            echo '<pre>';
            print_r($value);
            echo '</pre>';
        }
        exit;
	}
}


/* End of file debug_helper.php */
/* Location: ./application/helpers/debug_helper.php */