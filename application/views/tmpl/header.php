<!DOCTYPE html> 
<html> 
<head> 
<title><?php echo $titulo; ?></title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

<link href="/assets/css/main.css" media="screen" rel="stylesheet" type="text/css" /> 
 
</head> 
<body>
    <?php $this->load->view('divheader'); ?>
    <?php $this->load->view('divnavigation'); ?>
    <?php $this->load->view('divmain'); ?>