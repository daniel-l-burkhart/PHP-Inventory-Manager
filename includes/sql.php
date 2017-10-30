<?php
require_once('load.php');

/**
 * Gets all records from a table
 *
 * @param $table
 *      The name of the table
 * @return array
 *      Array of all the records from the table.
 */
function get_all_from_table($table)
{
    global $db;
    if (tableExists($table)) {
        return find_by_sql("SELECT * FROM " . $db->get_escape_string($table));
    }
}

/**
 * Runs SQL query and returns the result
 * @param $sql
 *      The SQL command, 'Select * from Table'
 * @return array
 *      The array of the result set.
 */
function find_by_sql($sql)
{
    global $db;
    $result = $db->run_query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

/**
 * Finds a single record from a table, used in "edit."
 *
 * @param $table
 *      The table
 * @param $id
 *      The item's id
 * @return array|null
 *      The result if it exists, null otherwise.
 */
function find_record_by_id($table, $id)
{
    global $db;
    $id = (int)$id;
    if (tableExists($table)) {
        $sql = $db->run_query("SELECT * FROM {$db->get_escape_string($table)} WHERE id='{$db->get_escape_string($id)}' LIMIT 1");
        if ($result = $db->fetch_associative_array($sql)) {
            return $result;
        } else {
            return null;
        }
    }
}

/**
 * Deletes a record by ID
 *
 * @param $table
 *      The table
 * @param $id
 *      The ID
 * @return bool
 *      True if effective, false otherwise
 */
function delete_by_id($table, $id)
{
    global $db;
    if (tableExists($table)) {
        $sql = "DELETE FROM " . $db->get_escape_string($table);
        $sql .= " WHERE id=" . $db->get_escape_string($id);
        $sql .= " LIMIT 1";
        $db->run_query($sql);
        return ($db->affected_rows() === 1) ? true : false;
    }
}

/**
 * Makes sure the table passed in exists.
 *
 * @param $table
 *      The table
 * @return bool
 *      True if table exists, false otherwise.
 */
function tableExists($table)
{
    global $db;
    $table_exit = $db->run_query('SHOW TABLES FROM ' . DB_NAME . ' LIKE "' . $db->get_escape_string($table) . '"');
    if ($table_exit) {
        if ($db->num_rows($table_exit) > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Called at login
 *
 * @param string $username
 *      The username
 * @param string $password
 *      The password
 * @return array|bool|null
 *      returns the user if successful, false otherwise.
 */
function authenticate_user($username = '', $password = '')
{
    global $db;
    $username = $db->get_escape_string($username);
    $password = $db->get_escape_string($password);
    $sql = sprintf("SELECT id,username,password,user_level, status FROM users WHERE username ='%s' LIMIT 1", $username);
    $result = $db->run_query($sql);
    if ($db->num_rows($result)) {

        $user = $db->fetch_associative_array($result);

        if ($user['status'] === '1') {

            $password_request = sha1($password);

            if ($password_request === $user['password']) {
                return $user;
            }
        }
    }
    return false;
}

/**
 * If the user is logged in, gets the active user.
 *
 * @return array|null
 *      Returns the user if the logged in, null otherwise.
 */
function current_user()
{
    static $current_user;

    if (!$current_user) {
        if (isset($_SESSION['user_id'])) {
            $user_id = intval($_SESSION['user_id']);
            $current_user = find_record_by_id('users', $user_id);
        }
    }
    return $current_user;
}

/**
 * Gets all users - used at users.php with admin access level
 *
 * @return array
 *      All the users
 */
function find_all_user()
{
    $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login, g.group_name FROM users u, user_groups g WHERE g.group_level=u.user_level AND u.status = '1' ORDER BY u.name ASC";
    $result = find_by_sql($sql);
    return $result;
}

function find_unapproved_users()
{
    $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login, g.group_name FROM users u, user_groups g WHERE g.group_level=u.user_level AND u.status = '0' ORDER BY u.name ASC";
    $result = find_by_sql($sql);
    return $result;

}

function unapproved_users_count()
{

    global $db;

    $sql = "SELECT * FROM users u, user_groups g WHERE g.group_level=u.user_level AND u.status = '0' ORDER BY u.name ASC";

    $row_cnt = 0;

    if ($result = $db->run_query($sql)) {

        $row_cnt = $db->num_rows($result);
    }

    return $row_cnt;

}

/**
 * Updates user table with latest timestamp of successful login.
 *
 * @param $user_id
 *      The user's ID
 * @return bool
 *      True if effective, false otherwise
 */
function updateLastLogIn($user_id)
{
    global $db;

    $sql = "UPDATE users SET last_login=NOW() WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->run_query($sql);

    if ($result && $db->affected_rows() === 1) {
        return true;
    } else {
        return false;
    }
}

/**
 * Finds the group level from the group table - admin, manager, etc
 *
 * @param $level
 *      The level of the user
 * @return bool
 *      True if not found, false otherwise
 */
function find_by_groupLevel($level)
{
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->get_escape_string($level)}' LIMIT 1 ";
    $result = $db->run_query($sql);

    if ($db->num_rows($result) === 0) {
        return true;
    } else {
        return false;
    }
}


/**
 * Validates that the user has the right access level
 *
 * @param $require_level
 *      The require level
 * @return bool
 *      True if user has the privilege, false otherwise.
 */
function validate_access_level($require_level)
{
    global $session;
    $current_user = current_user();
    $login_level = find_by_groupLevel($current_user['user_level']);

    if (!$session->isUserLoggedIn()) {
        $session->msg('danger', 'Please login...');
        redirect_to_page('/~dburkhart1/project2/index.php', false);
    }

    if ($login_level['group_status'] === '0') {
        $session->msg('danger', 'This level user has been removed!');
        redirect_to_page('/~dburkhart1/project2/home.php', false);
    }

    if ($current_user['user_level'] <= (int)$require_level) {
        return true;

    } else {
        $session->msg("danger", "Sorry! you dont have permission to view the page.");
        redirect_to_page('/~dburkhart1/project2/home.php', false);
    }

}

/**
 * Gets the user level
 * @return mixed
 *      Returns the user level if it exists
 */
function get_user_level()
{
    $current_user = current_user();
    return $current_user['user_level'];
}

/**
 * Gets all of the products from the product table.
 *
 * @return array
 *      The list of products
 */
function get_all_products()
{
    $sql = " SELECT p.id,p.name,p.quantity,p.cost_price,p.sale_price,p.date,c.name";
    $sql .= " AS category";
    $sql .= " FROM products p, categories c";
    $sql .= " WHERE c.id = p.category_id";
    $sql .= " ORDER BY p.id ASC";

    return find_by_sql($sql);
}

/**
 * Finds the product by name
 * @param $product_name
 *      The name of the product
 * @return array
 *      The result
 */
function find_product_by_title($product_name)
{
    global $db;
    $p_name = make_HTML_compliant($db->get_escape_string($product_name));
    $sql = "SELECT name FROM products WHERE name like '%$p_name%' LIMIT 5";
    $result = find_by_sql($sql);
    return $result;
}

function find_all_product_info_by_title($title)
{
    $sql = "SELECT * FROM products ";
    $sql .= " WHERE name ='{$title}'";
    $sql .= " LIMIT 1";
    return find_by_sql($sql);
}

function update_product_qty($qty, $p_id)
{
    global $db;
    $qty = (int)$qty;
    $id = (int)$p_id;
    $sql = "UPDATE products SET quantity=quantity -q{$qty}ty WHERE id = '{$id}'";
    $result = $db->run_query($sql);

    if ($db->affected_rows() === 1) {
        return true;
    } else {
        return false;
    }

}

function find_recent_product_added($limit)
{
    global $db;
    $sql = " SELECT p.id,p.name,p.sale_price,c.name AS category";
    $sql .= " FROM products p, categories c";
    $sql .= " WHERE c.id = p.category_id";
    $sql .= " ORDER BY p.id DESC LIMIT " . $db->get_escape_string((int)$limit);
    return find_by_sql($sql);
}

function find_highest_selling_product($limit)
{
    global $db;
    $sql = "SELECT p.name, COUNT(s.product_id) AS totalSold, SUM(s.quantity) AS totalQty";
    $sql .= " FROM sales s, products p";
    $sql .= " WHERE p.id = s.product_id ";
    $sql .= " GROUP BY s.product_id";
    $sql .= " ORDER BY SUM(s.quantity) DESC LIMIT " . $db->get_escape_string((int)$limit);
    return $db->run_query($sql);
}

function find_all_sales()
{
    $sql = "SELECT s.id,s.quantity,s.price,s.date,p.name";
    $sql .= " FROM sales s, products p";
    $sql .= " WHERE s.product_id = p.id";
    $sql .= " ORDER BY s.date DESC";
    return find_by_sql($sql);
}


function find_recent_sale_added($limit)
{
    global $db;
    $sql = "SELECT s.id,s.quantity,s.price,s.date,p.name";
    $sql .= " FROM sales s, products p";
    $sql .= " WHERE s.product_id = p.id";
    $sql .= " ORDER BY s.date DESC LIMIT " . $db->get_escape_string((int)$limit);
    return find_by_sql($sql);
}


function find_sale_by_dates($start_date, $end_date)
{
    global $db;

    $start_date = date("Y-m-d", strtotime($start_date));
    $end_date = date("Y-m-d", strtotime($end_date));

    $sql = "SELECT s.date, p.name,p.sale_price,p.cost_price,";
    $sql .= "COUNT(s.product_id) AS total_records,";
    $sql .= "SUM(s.quantity) AS total_sales,";
    $sql .= "SUM(p.sale_price * s.quantity) AS total_selling_price,";
    $sql .= "SUM(p.cost_price * s.quantity) AS total_cost_price ";
    $sql .= "FROM sales s, products p ";
    $sql .= " WHERE s.product_id = p.id";
    $sql .= " AND s.date BETWEEN '{$start_date}' AND '{$end_date}'";
    $sql .= " GROUP BY DATE(s.date),p.name";
    $sql .= " ORDER BY DATE(s.date) DESC";

    //return find_by_sql($sql);
    return $db->run_query($sql);
}

function dailySales($year, $month)
{
    $sql = "SELECT s.quantity,";
    $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
    $sql .= "SUM(p.sale_price * s.quantity) AS total_selling_price";
    $sql .= " FROM sales s, products p";
    $sql .= " WHERE s.product_id = p.id";
    $sql .= " AND DATE_FORMAT(s.date, '%Y-%m' ) = '{$year}-{$month}'";
    $sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
    return find_by_sql($sql);
}

function monthlySales($year)
{
    $sql = "SELECT s.quantity,";
    $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
    $sql .= "SUM(p.sale_price * s.quantity) AS total_selling_price";
    $sql .= " FROM sales s, products p";
    $sql .= " WHERE s.product_id = p.id";
    $sql .= " AND DATE_FORMAT(s.date, '%Y' ) = '{$year}'";
    $sql .= " GROUP BY DATE_FORMAT( s.date,  '%c' ),s.product_id";
    $sql .= " ORDER BY date_format(s.date, '%c' ) ASC";
    return find_by_sql($sql);
}
