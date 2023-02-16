<?php

    /*===== fungsi standar untuk membentuk response message =====*/
    function message($a, $b, $c, $d) {
        return ['error' => $a, 'status' => $b, 'id' => $c, 'message' => $d];
    }

	
/*============== for API KEY ===========*/

function token_generate_key()
{
 $ci = &get_instance();
  do
  {
            // Generate a random salt
    $salt = base_convert(bin2hex($ci->security->get_random_bytes(64)), 16, 36);

            // If an error occurred, then fall back to the previous method
    if ($salt === FALSE)
    {
      $salt = hash('sha256', time() . mt_rand());
    }

    $new_key = substr($salt, 0, config_item('rest_key_length'));
  }
  while (token_key_exists($new_key));

  return $new_key;
}

function token_get_key($key)
{
 $ci = &get_instance();
  return $ci->rest->db
  ->where(config_item('rest_key_column'), "'{$key}'")
  ->get(config_item('rest_keys_table'))
  ->row();
}

function token_key_exists($key)
{
  $ci = &get_instance();
  return $ci->rest->db
  ->where(config_item('rest_key_column'), "'{$key}'")
  ->get(config_item('rest_keys_table'))->num_rows() > 0;
}

function token_insert_key($key, $data)
{
  $data[config_item('rest_key_column')] = "'{$key}'";
  $data['create_at'] = date('Y-m-d H:i:s');

  $ci = &get_instance();
  return $ci->rest->db
  ->set($data)
  ->insert(config_item('rest_keys_table'));
}

function token_update_key($key, $data)
{
  $ci = &get_instance();
  return $ci->rest->db
  ->where(config_item('rest_key_column'), "'{$key}'")
  ->update(config_item('rest_keys_table'), $data);
}

function token_delete_key($key)
{
  $ci = &get_instance();
  return $ci->rest->db
  ->where(config_item('rest_key_column'), "'{$key}'")
  ->delete(config_item('rest_keys_table'));
}
