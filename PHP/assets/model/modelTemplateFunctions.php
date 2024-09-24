<?php

require_once 'connection.php';

class Template{

    //Standard Registration Form
    function registerTemplate($input1, $input2, $input3){
        global $conn;

        $stmt = $conn->prepare("INSERT INTO template (bi, nome, morada) VALUES (?, ?, ?);");
        $stmt->bind_param("ids", $input1, $input2, $input3);
        $stmt->execute();

        $msg = "Template registado com sucesso.";

        $stmt->close();
        $conn->close();

        return $msg;
    }

    //Registration Form with Image Input
    function registerTemplateWithImg($input1, $input2, $imgInput){
        global $conn;
        $stmt = "";

        $resp = $this -> uploads($imgInput, $input1);
        $resp = json_decode($resp, TRUE);

        if($resp['flag']){
            $stmt = $conn->prepare("INSERT INTO template (bi, nome, img) VALUES (?, ?, ?);");
            $stmt->bind_param("ids", $input1, $input2, $resp['target']);
        }else{
            $stmt = $conn->prepare("INSERT INTO template (bi, nome) VALUES (?, ?);");
            $stmt->bind_param("id", $input1, $input2);
        }

        $stmt->execute();
        $id = $stmt->insert_id;

        $stmt->close();
        $conn->close();

        return $id;
    }

    function uploads($img, $input1){

        $dir = "../images/template/";
        $dir1 = "assets/images/template/";
        $flag = false;
        $targetBD = "";
    
        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, TRUE)){
                die ("Erro. Não é possivel criar o diretório");
            }
        }
      if(array_key_exists('img', $img)){
        if(is_array($img)){
          if(is_uploaded_file($img['img']['tmp_name'])){
            $source = $img['img']['tmp_name'];
            $file = $img['img']['name'];
            $end = explode(".",$file);
            $extension = end($end);
    
            $newName = $input1.date("YmdHis").".".$extension;
    
            $target = $dir.$newName;
            $targetBD = $dir1.$newName;

            $this -> wFile($target);
    
            $flag = move_uploaded_file($source, $target);
            
          } 
        }
      }
        return (json_encode(array(
          "flag" => $flag,
          "target" => $targetBD
        )));
    }

    function wFile($txt){
        $file = '../img_logs.txt';
        // Open the file to get existing content
        $current = file_get_contents($file);
        // Append a new person to the file
        $current .= $txt."\n";
        // Write the contents back to the file
        file_put_contents($file, $current);
    }

    //Standard Select - Table
    function getTemplateTable(){
        global $conn;
        $msg = "<table class='table table-striped'>";
        $msg .= "<thead>";
        $msg .= "<tr>";
        $msg .= "<th scope='col'>Imagem</th>";
        $msg .= "<th scope='col'>ID</th>";
        $msg .= "<th scope='col'>Descrição</th>";
        $msg .= "<th scope='col'>Editar</th>";
        $msg .= "<th scope='col'>Remover</th>";
        $msg .= "</tr>";
        $msg .= "</thead>";
        $msg .= "<tbody>";

        $stmt = $conn->prepare("SELECT * FROM template");
        $stmt->execute();

        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    $msg .= "<tr>";
                    $msg .= "<td><img src='".$row['img']."' class='img-thumbnail' alt='".$row['descricao']."'></td>";
                    $msg .= "<td>".$row['id']."</td>";
                    $msg .= "<td>".$row['descricao']."</td>";
                    $msg .= "<td><button type='button' class='btn btn-outline-primary' onclick='getTemplateDetails(".$row['id'].")'>Editar</button></td>";
                    $msg .= "<td><button type='button' class='btn btn-outline-danger' onclick='removeTemplate(".$row['id'].")'>Remover</button></td>";
                    $msg .= "</tr>";
                }
        } else {
            $msg .= "<tr>";
            $msg .= "<td>Sem templates registados</td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "</tr>";
        }

        $msg .= "</tbody>";
        $msg .= "</table>";
  
        $stmt->close();
        $conn->close();

        return $msg;
    }

    //Select - Table w/ Filter
    function getFilteredTemplateTable($filter){
        global $conn;
        $msg = "<table class='table table-striped'>";
        $msg .= "<thead>";
        $msg .= "<tr>";
        $msg .= "<th scope='col'>Imagem</th>";
        $msg .= "<th scope='col'>ID</th>";
        $msg .= "<th scope='col'>Descrição</th>";
        $msg .= "<th scope='col'>Editar</th>";
        $msg .= "<th scope='col'>Remover</th>";
        $msg .= "<th scope='col'>Quantidade</th>";
        $msg .= "<th scope='col'>Selecionar</th>";
        $msg .= "</tr>";
        $msg .= "</thead>";
        $msg .= "<tbody>";

        $stmt = $conn->prepare("SELECT * FROM template");
        $stmt->execute();

        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    if($row['id'] == $filter){
                        $msg .= "<tr>";
                        $msg .= "<td><img src='".$row['img']."' class='img-thumbnail' alt='".$row['descricao']."'></td>";
                        $msg .= "<td>".$row['id']."</td>";
                        $msg .= "<td>".$row['descricao']."</td>";
                        $msg .= "<td><button type='button' class='btn btn-outline-primary' onclick='getTemplateDetails(".$row['id'].")'>Editar</button></td>";
                        $msg .= "<td><button type='button' class='btn btn-outline-danger' onclick='removeTemplate(".$row['id'].")'>Remover</button></td>";
                        $msg .= "<td><input type='number' class='form-control form-control-sm' id='quantTemplate".$row['id']."' required>";
                        $msg .= "<td><input type='checkbox' id='checkTemplate".$row['id']."' value='".$row['id']."'></td>";
                        $msg .= "</tr>";
                    }
                }
        } else {
            $msg .= "<tr>";
            $msg .= "<td>Sem templates registados</td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "</tr>";
        }

        $msg .= "</tbody>";
        $msg .= "</table>";
  
        $stmt->close();
        $conn->close();

        return $msg;
    }

    //List Description Table Method
    function getBulletPointDescriptionTemplate($id){
        global $conn;

        $msg = "<td><ul>";

        $stmt = $conn->prepare("SELECT * FROM template AND template.attr = ?;");
        $stmt->bind_param("i", $id); 
        $stmt->execute();
        
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<li>".$row['descricao']."</li>";
            }
        }
        
        $msg .= "</ul></td>";

        return $msg;
    }

    //Standard Select - Dropdown Select
    function getTemplateSelect(){
        global $conn;
        $msg = "<option value='-1'>Selecione um template</option>";

        $stmt = $conn->prepare("SELECT * FROM template;"); 
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value='".$row['id']."'>".$row['id']." | ".$row['descricao']."</option>";
            }
        }else{
            $msg = "<option value='-1'>Sem templates registados</option>";
        }
        
        $stmt->close();
        $conn->close();

        return $msg;
    }

    //Standard Select - Filter Dropdown Select
    function getTemplateSelect(){
        global $conn;
        $msg = "<option value='-1'>Ver todos</option>";

        $stmt = $conn->prepare("SELECT * FROM template;"); 
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value='".$row['id']."'>".$row['id']." | ".$row['descricao']."</option>";
            }
        }else{
            $msg = "<option value='-1'>Sem templates registados</option>";
        }
        
        $stmt->close();
        $conn->close();

        return $msg;
    }

    //Standard Select - Dropdown Select w/Other Option
    function getAlternativeTemplateSelect(){
        global $conn;
        $msg = "<option value='-1'>Selecione um template</option>";

        $stmt = $conn->prepare("SELECT * FROM template;"); 
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        while($row = $result->fetch_assoc()) {
            $msg .= "<option value='".$row['id']."'>".$row['template']."</option>";
        }

        $msg .= "<option value='-2'>Outro</option>";
        
        $stmt->close();
        $conn->close();

        return $msg;
    }

    //Standard Select - Details
    function getTemplateDetails($id){
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM template WHERE template.id = ?");
        $stmt ->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return json_encode($row);
    }

    //Standard Update
    function editTemplate($id, $newId, $input1, $img){
        global $conn;
        $resp = "";
        $stmt = "";

        if($pic != null){
            $resp = $this -> uploads($img, $input1);
            $resp = json_decode($resp, TRUE);
        }

        if($resp['flag']){
            $stmt = $conn->prepare("UPDATE template SET descricao = ?, id = ?, img = ? WHERE template.id = ? ;");
            $stmt->bind_param("sisi", $input1, $newId, $resp['target'], $id);
        }else{
            $stmt = $conn->prepare("UPDATE template SET descricao = ?, id = ? WHERE template.id = ? ;");
            $stmt->bind_param("sisi", $input1, $newId, $id);
        }
        
        $stmt->execute();

        $msg = "Template editado com sucesso!";

        $stmt->close();
        $conn->close();

        return $msg;
    }

    //Standard Delete
    function removeTemplate($id){
        global $conn;

        $flag = $this -> getTemplateStatus($id);

        if($flag){
            $stmt = $conn->prepare("DELETE FROM template WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $msg = "Template removido com sucesso.";
        }else{
            $msg = "Não é possível remover templates em estado ativo.";
        }

        $stmt->close();
        $conn->close();

        return $msg;
    }

    function getTemplateStatus($id){
        $flag = true;

        $stmt = $conn->prepare("SELECT id FROM template WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $flag = false;
        }
  
        return $flag;
    }


    //Utilities
    function updateTemplateStock($id, $quant){
        global $conn;

        $resp = $this->getTemplateQuant($id);
        $resp = json_decode($resp, TRUE);

        $newTotal = $resp['total'] - $quant;

        $stmt = $conn->prepare("UPDATE template SET total = ? WHERE id = ? ;");
        $stmt->bind_param("ii", $newTotal, $id);
        $stmt->execute();

        $msg = "Stock atualizado.";

        $stmt->close();
        $conn->close();

        return $msg;
    }

    function getTemplateQuant($id){
        global $conn;

        $stmt = $conn->prepare("SELECT template.total FROM template WHERE template.id = ?;");
        $stmt->bind_param("i", $id); 
        $stmt->execute();
        
        $result = $stmt->get_result();

        $msg = $result->fetch_assoc();

        return json_encode($msg);
    }
}

?>