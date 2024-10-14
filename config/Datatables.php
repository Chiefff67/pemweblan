<?php

class Datatables
{
    public function getQuery($conn, $query, $where, $search_columns)
    {
        // Get search value
        $search = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

        // Prepare search condition
        $search_condition = '';
        if (!empty($search)) {
            $search_parts = [];
            foreach ($search_columns as $col) {
                $search_parts[] = "$col LIKE :search";
            }
            $search_condition = '(' . implode(' OR ', $search_parts) . ')';
        }

        // Prepare WHERE clause
        $where_clause = '';
        $where_params = [];
        if (!empty($where)) {
            $where_parts = [];
            foreach ($where as $key => $value) {
                $where_parts[] = "$key = :$key";
                $where_params[":$key"] = $value;
            }
            $where_clause = implode(' AND ', $where_parts);
        }

        // Combine WHERE and search conditions
        $final_where = '';
        if (!empty($where_clause) && !empty($search_condition)) {
            $final_where = "WHERE $where_clause AND $search_condition";
        } elseif (!empty($where_clause)) {
            $final_where = "WHERE $where_clause";
        } elseif (!empty($search_condition)) {
            $final_where = "WHERE $search_condition";
        }

        // Count total records
        $count_sql = "SELECT COUNT(*) as count FROM ($query) as subquery $final_where";
        $stmt = $conn->prepare($count_sql);
        if (!empty($search)) {
            $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        }
        foreach ($where_params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        $total_records = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        // Prepare final query with pagination
        $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
        $length = isset($_POST['length']) ? intval($_POST['length']) : 10;

        $order_column = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
        $order_dir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'ASC';
        $order_column_name = $_POST['columns'][$order_column]['data'];

        $final_sql = "$query $final_where ORDER BY $order_column_name $order_dir LIMIT :start, :length";

        $stmt = $conn->prepare($final_sql);
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':length', $length, PDO::PARAM_INT);
        if (!empty($search)) {
            $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        }
        foreach ($where_params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            "draw" => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
    }
}
