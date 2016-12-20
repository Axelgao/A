<?php

/**
 * 159.339 Internet Programming Assignment 3
 * Team Student : Shenchuan Gao (16131180)
 */


$connect = mysqli_connect("localhost", "a3", "a3", "a3");
$output = '';
if(isset($_POST["search"])){
    $sql = "SELECT * FROM tbl_toolshed WHERE tool_name LIKE '%".$_POST["search"]."%'";
}
else{
    $sql = "SELECT * FROM tbl_toolshed";
}
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result) > 0)
{
    $output .= '<div class="table-responsive" id="result">  
                          <table class="table table bordered">  
                               <tr>  
                                    <th>SKU</th>  
                                    <th>Name</th>  
                                    <th>Category</th>  
                                    <th>Cost</th>  
                                    <th>Stock QTY</th>  
                               </tr>';
    while($row = mysqli_fetch_array($result))
    {
        $output .= '  
                <tr>  
                     <td>' . $row["SKU"] . '</td>  
                     <td>' . $row["TOOL_NAME"] . '</td>  
                     <td>' . $row["CATEGORY"] . '</td>  
                     <td>' . $row["COST"] . '</td>  
                     <td>' . $row["STOCK_QTY"] . '</td>  
                </tr>  
           ';
    }
    echo $output;
}
else
{
    echo 'Data Not Found';
}
?>
