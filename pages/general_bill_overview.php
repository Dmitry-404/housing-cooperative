<?
    require_once('../src/connect.php');
    require_once('../src/Apartament.php');
    require_once('../src/User.php');
    require_once('../src/ApartamentBill.php');
    require_once('../src/Service.php');
    require_once('../src/GeneralBill.php');
    session_start();
    if($_SESSION["user"]){
        if($_SESSION["user"]->get_housekeeper() == 1){
          require_once '../html/header_admin.html';
        }
        else {
          require_once '../html/header.html';
        }
    }
?>
<table class="table table-bordered border-primary " style="width: 80%; margin-top:10px;" align="center">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Послуга</th>
      <th scope="col">Вартість послуги, грн</th>
      <th scope="col">Дата</th>
    </tr>
  </thead>
  <tbody>
  <?GeneralBill::draw_made_payment($connection);?>
  </tbody>
</table>
<?
require_once "../html/footer.html";
?>