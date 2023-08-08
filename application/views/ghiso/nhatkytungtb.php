<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('images/logo.png');?>" type="image/ico">
    <title>Nhật ký từng thiết bị</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url();?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- keyboard -->
    <link rel="stylesheet" href="<?= base_url() ?>vendors/keyboard/jqbtk.css">
    <link rel="stylesheet" href="<?= base_url() ?>vendors/keyboard/jqbtk.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/toastr/build/toastr.min.css">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>build/css/custom.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('css/toggle.css?v=1') ?>">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style type="text/css">
      thead{background-color: #2980B9;}
      th{
        text-align: center;
        color:black;
      }
      td{
        text-align: center;
        color:#47476b;
      }
      .modal-header{
        background-color: #2980B9; color: white
      }

      .autocomplete {
          /*the container must be positioned relative:*/
          position: relative;
          display: inline-block;
          width: 100%;
        }
        input {
          border: 1px solid transparent;
          background-color: #f1f1f1;
          padding: 10px;
          font-size: 16px;
        }
        input[type=text] {
          background-color: #f1f1f1;
          width: 100%;
        }

        .autocomplete-items {
          position: absolute;
          border: 1px solid #d4d4d4;
          border-bottom: none;
          border-top: none;
          z-index: 99;
          /*position the autocomplete items to be the same width as the container:*/
          top: 100%;
          left: 0;
          right: 0;
        }
        .autocomplete-items div {
          padding: 10px;
          cursor: pointer;
          background-color: #fff;
          border-bottom: 1px solid #d4d4d4;

        }
        .autocomplete-items div:hover {
          /*when hovering an item:*/
          background-color: #e9e9e9;
        }
        .autocomplete-active {
          /*when navigating through the items using the arrow keys:*/
          background-color: DodgerBlue !important;
          color: #ffffff;
        }


        /*ui autocomple*/

        .ui-autocomplete .ui-menu-item{
          font-style:italic;
          color:gray;
          background-color: white;
          width: 100%;
        }

        .ui-autocomplete .ui-menu-item:hover{
          font-style:italic;
          color: white;
          font-weight: bold;
          font-size: 17px;
          background-color: #3498DB;
        }
        .ui-autocomplete {
          z-index:2147483647;
        }
        .ui-helper-hidden-accessible { display:none; }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       <!--menu-->
         <?php $this->load->view('master/menu')?>
      <!--end menu-->
        <!-- top navigation -->
          <?php $this->load->view('master/header')?>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nhật ký từng thiết bị</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Ghi sổ nhật ký</a></li>
                <li><a data-toggle="tab" href="#menu1">Nhật ký bảo trì, sửa chữa</a></li>
                <li><a data-toggle="tab" href="#menu2">Năm sử dụng</a></li>
              </ul>
              <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#modalthem">
                        <i class="fa fa-calendar"></i> 
                          Thêm lịch sử dụng
                      </button>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#modalin">
                        <i class="fa fa-file"></i> 
                          In sổ nhật ký
                      </button>
                      

                      <div class="x_content">

                        <div class="row">
                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>NĂM SỬ DỤNG</label>
                              <select id="namsdsearch" class="form-control" onchange="laydulieu()">
                                <?php foreach ($arr_namsd as $val): ?>
                                  <option value="<?= $val->id ?>">
                                   Năm <?= $val->namsd ?>
                                  </option>
                                <?php endforeach ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>PHÒNG MÁY</label>
                              <select class="form-control" id="phongsearch" required="required" class="form-control" onchange="laydulieu()">
                                <option value="0">Chọn phòng</option>
                                <?php foreach ($phong as $value): ?>
                                  <option value="<?= $value->id ?>"><?= $value->maphong ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                          </div>
                        </div>

                        

                        <table id="datatable-buttons" class="table table-striped">
                          <thead>
                            <tr>
                              <th>Thiết bị</th>
                              <th>Ngày</th>
                              <th>Giờ vào - ra</th>
                              <th>Mục đích sử dụng</th>
                              <th>Tình trạng trước khi sử dụng</th>
                              <th>Tình trạng sau khi sử dụng</th>
                              <th>Giáo viên sử dụng</th>
                              <th>Thao tác</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                  <h3>Nhật ký bảo trì</h3>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>NĂM BẢO TRÌ</label>
                          <select id="namsdloc_baotri" class="form-control" onchange="laydulieubaotri()">
                            <?php foreach ($arr_namsd as $val): ?>
                              <option value="<?= $val->namsd ?>">Năm <?= $val->namsd ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>

                      </div>

                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>PHÒNG MÁY</label>
                          <input id="phongbaotri_loc" required="required" type="text" placeholder="Nhập tên phòng (VD: A201)" class="keyboard form-control">
                        </div>

                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalthembaotri">
                          <i class="fa fa-calendar"></i> 
                            Thêm lịch bảo trì
                        </button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalin_baotri">
                          <i class="fa fa-file"></i> 
                            In sổ bảo trì
                        </button>
                      </div>


                    </div>

                      <table id="bangbaotri" class="table table-striped table-bordered" style="font-size: 10px;width: 100%;">
                        <thead>
                          <tr>
                            <th>#</th> 
                            <th>Tên TB</th>
                            <th>Ngày bảo trì</th>
                            <th>Mô tả hư hỏng</th>
                            <th>Nội dung bảo trì</th>
                            <th>Người bảo trì</th>
                            <th>Người kiểm tra</th>
                            <th>Ghi chú</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                          </tr>
                        </thead>


                        
                      </table>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#modalthem_namsd">
                        <i class="fa fa-calendar"></i> 
                          Thêm năm sử dụng
                      </button>

                      <div class="x_content">

                        

                        <table id="datatable-buttons-namsd" class="table table-striped" style="font-size: 15px">
                          <thead>
                            <tr>
                              <th>Năm sử dụng</th>
                              <th>Thao tác</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($arr_namsd as $val): ?>
                              <tr>
                                <td><?php echo $val->namsd ?></td>
                                <td>
                                  <a class="btn btn-sm btn-danger" href="<?php echo nguoidung_url('nhatkytungtbcontroller/xoanamsd/'.$val->id) ?>">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                  </a>
                                </td>
                              </tr>
                            <?php endforeach ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        
        <!-- /page content -->
<!-- Modal thêm-->
<div class="modal fade" id="modalthem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Thêm mới</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" autocomplete="off"
          action="<?= nguoidung_url('nhatkytungtbcontroller/themnhatky') ?>" method="POST">
        <div class="modal-body">

        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label>NĂM SỬ DỤNG</label>
              <select id="namsd_add" name="namsd_add" class="form-control">
                <?php foreach ($arr_namsd as $val): ?>
                  <option value="<?= $val->id ?>">
                   Năm <?= $val->namsd ?>
                  </option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group autocomplete">
              <label>PHÒNG MÁY</label>
              <input id="idphongcu" hidden="hidden" name="idphongcu" required="required" type="text">
              <input id="phongmaycu" name="phongmaycu" required="required" type="text" placeholder="Nhập tên phòng" class="keyboard form-control">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group autocomplete">
              <label>GIÁO VIÊN</label>
              <select id="gvcu" name="gvcu" class="form-control" required>
                <option value="">----Chọn----</option>
                <?php foreach ($giaovien as $val): ?>
                  <option value="<?= $val->id ?>">
                    <?= $val->hoten ?> 
                  </option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label>NGÀY</label>
              <input type="date" id="ngaycu" name="ngaycu" class="form-control">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>GIỜ VÀO</label>
              <input autocomplete="off" id="giovaocu" name="giovaocu" required="required" class="form-control" placeholder="Chọn giờ vào" onchange="kiemtragio()">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>GIỜ RA</label>
              <input autocomplete="off" id="gioracu" name="gioracu" class="form-control" placeholder="Chọn giờ ra">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>THIẾT BỊ</label>
          <select class="form-control" id="thietbi" name="thietbi" required="required" class="form-control">
          </select>
        </div>

          <div class="form-group">
            <label>MÔN HỌC/MỤC ĐÍCH SỬ DỤNG</label>
            <textarea id="mucdichcu" name="mucdichcu" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG TRƯỚC KHI SỬ DỤNG</label>
            <textarea id="tinhtrangtruoccu" name="tinhtrangtruoccu" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG SAU KHI SỬ DỤNG</label>
            <textarea id="tinhtrangsaucu" name="tinhtrangsaucu" class="form-control" rows="3"></textarea>
          </div>
          
          

        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">Lưu</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal cập nhật--> 
<div class="modal fade" id="modalsua" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Cập nhật</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('nhatkytungtbcontroller/capnhatnhatky') ?>" method="POST" onsubmit="return validate_update()">
        <div class="modal-body">

          <div class="form-group">
            <label>PHÒNG MÁY</label>
            <input name="idUpdate" id="idUpdate" type="hidden" class="form-control" hidden="hidden" >
            <input name="idKhoUpdate" id="idKhoUpdate" type="hidden" class="form-control" hidden="hidden" >
            <input id="phongmayUpdate" name="phongmay" required="required" type="text" class="keyboard form-control" disabled>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>GIỜ VÀO</label>
                <input autocomplete="off" id="giovaoUpdate" name="giovao" required="required" class="form-control" placeholder="Chọn giờ vào">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>GIỜ RA</label>
                <input autocomplete="off" id="gioraUpdate" name="giora" required="required" class="form-control" placeholder="Chọn giờ ra">
              </div>
            </div>
          </div> 

          <div class="form-group">
            <label>MÔN HỌC/MỤC ĐÍCH SỬ DỤNG</label>
            <textarea id="mucdichUpdate" name="mucdich" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG TRƯỚC KHI SỬ DỤNG</label>
            <textarea id="tinhtrangtruocUpdate" name="tinhtrangtruoc" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>TÌNH TRẠNG SAU KHI SỬ DỤNG</label>
            <textarea id="tinhtrangsauUpdate" name="tinhtrangsau" required="required" class="form-control" rows="3"></textarea>
          </div>
          
          

        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">Lưu</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal in-->
<div class="modal fade" id="modalin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>In nhật ký</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('nhatkytungtbcontroller/xuatsonhatky') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>NĂM SỬ DỤNG</label>
            <select name="namsdin" class="form-control">
              <?php foreach ($arr_namsd as $val): ?>
                <option value="<?= $val->id ?>">
                 Năm <?= $val->namsd ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label>PHÒNG MÁY</label>
            <select class="form-control" name="phongmayin" required="required" class="form-control">
              <?php foreach ($phong as $value): ?>
                <option value="<?= $value->id ?>"><?= $value->maphong ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">In</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal thêm năm sử dụng-->
<div class="modal fade" id="modalthem_namsd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Thêm mới</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" autocomplete="off"
          action="<?= nguoidung_url('nhatkytungtbcontroller/themnamsd') ?>" method="POST">
        <div class="modal-body">

        <div class="form-group">
          <label>Năm sử dụng</label>
          <input type="number" name="namsd" class="form-control">
        </div>

        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">Lưu</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal thêm mới nhật ký bảo trì-->
<div class="modal fade" id="modalthembaotri" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Thêm nhật ký bảo trì</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" autocomplete="off"
        action="<?= nguoidung_url('nhatkytungtbcontroller/thembaotri') ?>" method="POST">
        <div class="modal-body">

          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>NĂM SỬ DỤNG</label>
                <select name="namsd_baotri" class="form-control">
                  <?php foreach ($arr_namsd as $val): ?>
                    <option value="<?= $val->id ?>">
                     Năm <?= $val->namsd ?>
                    </option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group autocomplete">
                <label>PHÒNG MÁY</label>
                <input id="idphong_baotri" hidden="hidden" name="idphong" required="required" type="text">
                <input id="phongmay_baotri" name="phongmay" required="required" type="text" placeholder="Nhập tên phòng" class="keyboard form-control">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label>DANH SÁCH THIẾT BỊ</label>
            <div class="form-group">
              <select class="form-control" id="thietbibaotri" name="thietbi[]" required="required" class="form-control" multiple size="10">
              </select>
            </div>
          </div>

          <div class="form-group">
            <label>NGÀY BẢO TRÌ</label>
            <input type="text" name="ngaybaotri" required="required" class="form-control" placeholder="Ngày/Tháng/Năm">
          </div>

          <div class="form-group">
            <label>MÔ TẢ HƯ HỎNG, NGUYÊN NHÂN</label>
            <textarea name="motabaotri" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>NỘI DUNG BẢO TRÌ, SỬA CHỮA</label>
            <textarea name="noidungbaotri" class="form-control" rows="3"></textarea>
          </div>

          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>NGƯỜI BẢO TRÌ/SỬA CHỮA</label>
                <input name="nguoibaotri" class="form-control" />
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label>NGƯỜI KIỂM TRA</label>
                <input name="nguoikiemtra" class="form-control" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>GHI CHÚ</label>
            <input name="ghichubaotri" class="form-control" />
          </div>

        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">Lưu</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal cập nhật nhật ký bảo trì-->
<div class="modal fade" id="modalcapnhatbaotri" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>Chỉnh sửa nhật ký bảo trì</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" autocomplete="off"
        action="<?= nguoidung_url('nhatkytungtbcontroller/capnhatbaotri') ?>" method="POST">
        <div class="modal-body">

          <div class="form-group">
            <input name="idUpdate" id="idUpdate_baotri" type="hidden" class="form-control" hidden="hidden" >
            <label>NGÀY BẢO TRÌ</label>
            <input type="text" id="ngaybaotri_update" name="ngaybaotri" required="required" class="form-control">
          </div>

          <div class="form-group">
            <label>MÔ TẢ HƯ HỎNG, NGUYÊN NHÂN</label>
            <textarea id="motabaotri_update" name="motabaotri" required="required" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>NỘI DUNG BẢO TRÌ, SỬA CHỮA</label>
            <textarea id="noidungbaotri_update" name="noidungbaotri" class="form-control" rows="3"></textarea>
          </div>

          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>NGƯỜI BẢO TRÌ/SỬA CHỮA</label>
                <input id="nguoibaotri_update" name="nguoibaotri" class="form-control" />
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label>NGƯỜI KIỂM TRA</label>
                <input id="nguoikiemtra_update" name="nguoikiemtra" class="form-control" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>GHI CHÚ</label>
            <input id="ghichubaotri_update" name="ghichubaotri" class="form-control" />
          </div>

        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary">Lưu</button>
          <button type="reset" class="btn btn-secondary" >Làm lại</button>
        </div>

      </form>
      
    </div>
  </div>
</div>

<!-- Modal in nhật ký bảo trì-->
<div class="modal fade" id="modalin_baotri" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;float: left;"><p>In sổ bảo trì/sửa chữa</p></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal form-label-left" 
          action="<?= nguoidung_url('nhatkytungtbcontroller/xuatnkbaotri') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>NĂM SỬ DỤNG</label>
            <select class="form-control" name="namsdin" required="required" class="form-control">
              <?php foreach ($arr_namsd as $val): ?>
                <option value="<?= $val->namsd ?>">
                 Năm <?= $val->namsd ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label>PHÒNG MÁY</label>
            <select class="form-control" name="phongmayin" required="required" class="form-control">
              <?php foreach ($phong as $value): ?>
                <option value="<?= $value->id ?>"><?= $value->maphong ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">In</button>
        </div>
      </form>
    </div>
  </div>
</div>



        <!-- footer content -->
        <footer>
          <?php $this->load->view('master/footer')?>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

<!-- Toastr -->
    <script src="<?= base_url() ?>/assets/toastr/build/toastr.min.js"></script>

<!-- datepicker -->
    <script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
    <link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
<!-- keyboard -->
    <script src="<?= base_url() ?>vendors/keyboard/jqbtk.js"></script>
    <script src="<?= base_url() ?>vendors/keyboard/jqbtk.min.js"></script>
  <!-- autocomplete -->
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>    

<script type="text/javascript">
  window.onload = function() {
         $('.dataTables_filter input[type="search"]').css(
           {'width':'8em','display':'inline-block'}
        );
    }
  // TIME PICKER
    var times = {};
    var timepicker = new TimePicker(['giovaocu', 'gioracu', 'giovaoUpdate', 'gioraUpdate'], {
      theme: 'blue-grey',
      lang: 'en'
    });

    timepicker.on('change', function(evt){
      var value = (evt.hour || '00') + ':' + (evt.minute || '00');
      evt.element.value = value;
      
      var id = evt.element.id;
      times[id] = value;

    });
  // END TIME PICKER

  $( "#phongmaycu" ).autocomplete({
      source: function( request, response ) {
          $.ajax({
              url: "<?= nguoidung_url('nhatkytungtbcontroller/timphongmay') ?>",
              method: "POST",
              async: false,
              data: {
                  q: request.term
              },
              success: function( data ) {
                  let arrResult = JSON.parse(data);
                  let arrPhong = [];
                  //ghép mảng
                  for(let i = 0; i < arrResult.length; i++){
                      arrPhong.push({label: arrResult[i].maphong +" ("+arrResult[i].tenphong+")", 
                        value: arrResult[i].id});
                  }
                  response( arrPhong);
              }
          });
      },
      select: function( event, ui ) {
          $('#idphongcu').val(ui.item.value);
          $("#phongmaycu").val(ui.item.label);
          chonphong(ui.item.value);
          return false;
      }
  });

  $( "#phongmay_baotri" ).autocomplete({
          source: function( request, response ) {
              $.ajax({
                  url: "<?= nguoidung_url('nhatkycontroller/timphongmay') ?>",
                  method: "POST",
                  async: false,
                  data: {
                      q: request.term
                  },
                  success: function( data ) {
                      
                      let arrResult = JSON.parse(data);
                      let arrPhong = [];
                      //ghép mảng
                      for(let i = 0; i < arrResult.length; i++){
                          arrPhong.push({label: arrResult[i].maphong +" ("+arrResult[i].tenphong+")", 
                            value: arrResult[i].id});
                      }
                      response( arrPhong);
                  }
              });
          },
          select: function( event, ui ) {
              $("#phongmay_baotri").val(ui.item.label);
              $("#idphong_baotri").val(ui.item.value);
              loadthietbibaotri(ui.item.value);
              return false;
          }
      });

  $( "#phongbaotri_loc" ).autocomplete({
          source: function( request, response ) {
              $.ajax({
                  url: "<?= nguoidung_url('nhatkycontroller/timphongmay') ?>",
                  method: "POST",
                  async: false,
                  data: {
                      q: request.term
                  },
                  success: function( data ) {
                      
                      let arrResult = JSON.parse(data);
                      let arrPhong = [];
                      //ghép mảng
                      for(let i = 0; i < arrResult.length; i++){
                          arrPhong.push({label: arrResult[i].maphong +" ("+arrResult[i].tenphong+")", 
                            value: arrResult[i].id});
                      }
                      response( arrPhong);
                  }
              });
          },
          select: function( event, ui ) {
              $("#phongbaotri_loc").val(ui.item.label);
              sessionStorage.setItem("idphong", ui.item.value);
              sessionStorage.setItem("tenphong", ui.item.label);
              laydulieubaotri();
              return false;
          }
      });

  function laydulieubaotri()
    {
      setTimeout(function(){ 
        idphong = sessionStorage.getItem("idphong");
        ma_namsd = $( "#namsdloc_baotri option:selected" ).val();
        sessionStorage.setItem("namsd", ma_namsd);

        if(idphong != null){
            $.ajax({
            url: "<?= nguoidung_url('nhatkytungtbcontroller/laydulieubaotri') ?>",
            method: "POST",
            async: false,
            data: {
              idphong: idphong,
              ma_namsd: ma_namsd
            },
            type: "application/json",
            success: function (data) {
                var data = JSON.parse(data);
                var mangketqua = data.mangketqua;
                var baseurl = "<?= nguoidung_url('nhatkytungtbcontroller/') ?>";
                
                const bangKetQua = $('#bangbaotri').DataTable();

                if (mangketqua.length != 0) {
                    bangKetQua.clear();
                    stt = 1;
                    for (let x of mangketqua) {

                      // xác định đường dẫn xóa
                      var urlXoa = baseurl + "xoabaotri/";
                      urlXoa = urlXoa+ x.id;
                      var thaotac = "";

                      thaotac = '<button class="btn btn-primary btn-sm rounded" style="padding: 6px" id="'+x.id+'" ngaybaotri="'+x.ngaybaotri+'" motahuhong="'+x.motahuhong+'" noidungbaotri="'+x.noidungbaotri+'" nguoibaotri="'+x.nguoibaotri+'" nguoikiemtra="'+x.nguoikiemtra+'" ghichu="'+x.ghichu+'" onclick="capnhatbaotri(this)"><i class="fa fa-pencil-square-o" style="color:white"></i></button>'
                            +
                            '<a class="btn btn-danger btn-sm rounded" style="padding: 6px" onclick="return dialogDelete()" href="'+urlXoa+'"><i class="fa fa-trash" style="color:white;"></i></a>';

                      var rowNode = bangKetQua.row.add([
                          stt,
                          x.maso+" - "+x.tentb,
                          reformatDate(x.ngaybaotri),
                          x.motahuhong,
                          x.noidungbaotri,
                          x.nguoibaotri,
                          x.nguoikiemtra,
                          x.ghichu,
                          x.ngay,
                          thaotac
                      ])
                      .draw(false);
                      stt++;
                    }
                }
                else
                {
                  bangKetQua.clear().draw();
                }

               
                $('#modalLoading').modal('hide');
            },
            error: function (xhr, status, errorThrown) {
              // toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
              alert("Có lỗi xảy ra, thử lại!"+errorThrown);
              $('#modalLoading').modal('hide');
            }
          });
        }
        
       }, 500);
      //$('#modalLoading').modal('hide');
    }

  function capnhatbaotri(obj)
    {
      var id=obj.id;
      var ngaybaotri=($("#"+id).attr("ngaybaotri"));
      var motahuhong=($("#"+id).attr("motahuhong"));
      var noidungbaotri=($("#"+id).attr("noidungbaotri"));
      var nguoibaotri=($("#"+id).attr("nguoibaotri"));
      var nguoikiemtra=($("#"+id).attr("nguoikiemtra"));
      var ghichu=($("#"+id).attr("ghichu"));

      // convert ngày bảo trì
      const [year, month, day] = ngaybaotri.split('-');
      const rs_ngaybaotri = [day, month, year].join('/');

      $("#ngaybaotri_update").val(rs_ngaybaotri);
      $("#motabaotri_update").val(motahuhong);
      $("#noidungbaotri_update").val(noidungbaotri);
      $("#nguoibaotri_update").val(nguoibaotri);
      $("#nguoikiemtra_update").val(nguoikiemtra);
      $("#ghichubaotri_update").val(ghichu);

      $("#idUpdate_baotri").val(id);
      $("#modalcapnhatbaotri").modal();
    }

  function loadthietbibaotri(maphong) {
      $.ajax({
        url: "<?= nguoidung_url('nhatkytinhtrangtbcontroller/laythietbi') ?>",
        method:"POST",
        data:{
          maphong: maphong,
        },
        success:function(data){
          var arrTinh = JSON.parse(data);
          var sel = document.getElementById('thietbibaotri');
          // clear select box
          $('#thietbibaotri')
              .find('option')
              .remove()
              .end()
          ;

          // add option for select
          arrTinh.forEach(function(element) {
            var opt = document.createElement('option');
            ghichu = (element['ghichu'] == "") ? "" : " - Ghi chú: "+ element['ghichu'];

            opt.appendChild( document.createTextNode("Mã TB: "+ element['maso']+ " - " +element['tentb']  + ghichu ));
            opt.value = element['id']; 
            sel.appendChild(opt); 
          });
        },
        error: function (xhr, status, errorThrown) {
          //toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
        }
      });
    }

  function chonphong(maphong) {
    $.ajax({
      url: "<?= nguoidung_url('sokhocontroller/laythietbi') ?>",
      method:"POST",
      data:{
        maphong: maphong,
      },
      success:function(data){
        var arrTinh = JSON.parse(data);
        var sel = document.getElementById('thietbi');
        // clear select box
        $('#thietbi')
            .find('option')
            .remove()
            .end()
        ;

        // add option for select
        arrTinh.forEach(function(element) {
          var opt = document.createElement('option');
          opt.appendChild( document.createTextNode(element['maso'] + " - "+ element['tentb'] + "("+element['mota'] + ")" ));
          opt.value = element['id']; 
          sel.appendChild(opt); 
        });
      },
      error: function (xhr, status, errorThrown) {
        //toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
      }
    });
  }

    
    $( document ).ready(function() {
      // load mess
      mess = "<?php echo $mess ?>";
      if(mess != ""){
        toastr.info("<?php echo $mess ?>", 'Thông báo');
      }

      idphong = sessionStorage.getItem("idphong");
      namsd = sessionStorage.getItem("namsd");
      $("#namsdloc_baotri").val(namsd);
      if(idphong != null && idphong != ""){
        document.getElementById("phongsearch").value = idphong;
        tenphong = sessionStorage.getItem("tenphong");
        document.getElementById("phongbaotri_loc").value = tenphong;
        laydulieubaotri();
      }
      

      laydulieu();
      $("#datatable-buttons").css("width", "100%");

      //lưu lại tab
      $('a[data-toggle="tab"]').click(function (e) {
          e.preventDefault();
          $(this).tab('show');
      });

      $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
          var id = $(e.target).attr("href");
          localStorage.setItem('selectedTab', id)
      });

      var selectedTab = localStorage.getItem('selectedTab');
      if (selectedTab != null) {
          $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
      }
    });
    function laydulieu()
    {
      // $("#loadbar").modal('show');
      setTimeout(function(){ 
        sessionStorage.setItem("idphong", $('#phongsearch').val());
        idphong = sessionStorage.getItem("idphong");
        ma_namsd = $( "#namsdsearch" ).val();

        $.ajax({
          url: "<?= nguoidung_url('nhatkytungtbcontroller/laydulieu') ?>",
          method: "POST",
          async: false,
          data: {
            idphong: idphong,
            ma_namsd: ma_namsd
          },
          type: "application/json",
          success: function (data) {
              var data = JSON.parse(data);
              var mangketqua = data.mangketqua;
              var baseurl = "<?= nguoidung_url('nhatkytungtbcontroller/') ?>";
              
              const bangKetQua = $('#datatable-buttons').DataTable();

              if (mangketqua.length != 0) {
                  bangKetQua.clear();
                  for (let x of mangketqua) {

                    // xác định đường dẫn xóa
                    var urlXoa = baseurl + "xoanhatky/";
                    urlXoa = urlXoa+ x.idNhatKy;
                    var thaotac = "";
                    if(x.hoten == "<?= $this->session->userdata("hoten") ?>" || "<?= $this->session->userdata("quyenhan") ?>" == "1"){
                       thaotac = '<button class="btn btn-primary btn-sm rounded" style="padding: 6px" id="'+x.idNhatKy+'" giovao="'+x.giovao+'" giora="'+x.giora+'" mucdichsd="'+x.mucdichsd+'" tinhtrangtruoc="'+x.tinhtrangtruoc+'" tinhtrangsau="'+x.tinhtrangsau+'" phongmay="'+x.maphong+'" onclick="hienthilichsu(this)"><i class="fa fa-pencil-square-o" style="color:white"></i></button>'
                            +
                            '<a class="btn btn-danger btn-sm rounded" style="padding: 6px" onclick="return dialogDelete()" href="'+urlXoa+'"><i class="fa fa-trash" style="color:white;"></i></a>';
                    }
                      var rowNode = bangKetQua.row.add([
                          x.maso + " - " +x.tentb,
                          reformatDate(x.ngay),
                          x.giovao + " - " + x.giora,
                          x.mucdichsd,
                          x.tinhtrangtruoc,
                          x.tinhtrangsau,
                          x.hoten,
                          thaotac
                          
                      ])
                      .draw(false);
                  }
              }
              else
              {
                bangKetQua.clear().draw();
              }
              sessionStorage.setItem("idphong", $('#phongsearch').val());
              // $("#loadbar").modal('hide');
          },
      });
       }, 500);
      
    }

    function dialogDelete()
    {
      if(window.confirm("Bạn có chắc xóa")==true){
        return true;
      }
      return false;
    }

    function hienthilichsu(obj)
    {
      var id=obj.id;

      var phongmayUpdate=($("#"+id).attr("phongmay"));
      
      $.ajax({
          url: "<?= nguoidung_url('nhatkycontroller/laytenphongkho') ?>",
          method: "POST",
          async: false,
          data: {
            idphong: phongmayUpdate
          },
          type: "application/json",
          success: function (data) {
              var data = JSON.parse(data);
              var giovaoUpdate=($("#"+id).attr("giovao"));
              var gioraUpdate=($("#"+id).attr("giora"));
              var mucdichUpdate=($("#"+id).attr("mucdichsd"));
              var tinhtrangtruocUpdate=($("#"+id).attr("tinhtrangtruoc"));
              var tinhtrangsauUpdate=($("#"+id).attr("tinhtrangsau")); 

              document.getElementById("idKhoUpdate").value = data.id;
              document.getElementById("phongmayUpdate").value = data.tenphong;
              document.getElementById("giovaoUpdate").value = giovaoUpdate;
              document.getElementById("gioraUpdate").value = gioraUpdate;
              document.getElementById("mucdichUpdate").value = mucdichUpdate;
              document.getElementById("tinhtrangtruocUpdate").value = tinhtrangtruocUpdate;
              document.getElementById("tinhtrangsauUpdate").value = tinhtrangsauUpdate;
              document.getElementById("idUpdate").value = id;

              $('#modalLoading').modal('hide');
              $("#modalsua").modal();              
          },
          error: function (xhr, status, errorThrown) {
            toastr.error("Có lỗi xảy ra, thử lại!", 'Thông báo');
            $('#modalLoading').modal('hide');
          }
      });
    }


    function reformatDate(dateStr)
    {
      dArr = dateStr.split("-");
      return dArr[2]+ "/" +dArr[1]+ "/" +dArr[0];
    }

    </script>
    

  <!-- jQuery -->
    <script src="<?php echo base_url();?>vendors/jquery/dist/jquery.min.js"> </script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url();?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url();?>vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url();?>vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>build/js/custom.min.js"></script>
    
  </body>
</html>