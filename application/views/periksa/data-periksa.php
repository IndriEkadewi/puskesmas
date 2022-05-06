<div class="container">
   <div class="row">
      <div class="col-sm-12 col-md-11">
         <div class="table-reponsive full-width">
            <table class="table table-bordered table-striped table-hover" id="table-datatable">
               <tr>
                  <td>No Periksa</td>
                  <td>Tanggal periksa</td>
                  <td>ID User</td>
                  <td>ID Poli</td>
                  <td>Tanggal Kembali</td>
                  <td>Tanggal Selesai</td>
                  <td>Terlambat</td>
                  <td>Status</td>
                  <td>Pilihan</td>
               </tr>

               <?php foreach($periksa as $p) { ?>
                  <tr>
                     <td><?= $p['no_periksa'] ?></td>
                     <td><?= $p['tgl_periksa'] ?></td>
                     <td><?= $p['id_user'] ?></td>
                     <td><?= $p['id_poli'] ?></td>
                     <td><?= $p['tgl_kembali'] ?></td>
                     <td>
                        <?= date('Y-m-d') ?>
                        <input type="hidden" name="tgl_selesai" id="tgl_selesai" value="<?= date('Y-m-d') ?>">
                     </td>
                     <td>
                        <?php 
                           $tgl1 = new DateTime($p['tgl_kembali']);
                           $tgl2 = new DateTime();

                           if (date('Y-m-d') > $p['tgl_kembali']) {
                              $selisih = $tgl2->diff($tgl1)->format("%a");  
                           } else {
                              $selisih = 0;
                           }
                           
                           echo $selisih;
                        ?> Hari
                     </td>
                     <?php if($p['status'] == 'Periksa') { $status ='warning'; } else { $status = 'secondary'; } ?>
                     <td><i class="<?= "btn btn-outline-".$status ?>"><?= $p['status'] ?></i></td>
                     <td nowrap>
                        <?php if($p['status'] == 'Selesai') { ?>
                        <span class="btn btn-sm btn-outline-secondary">
                           <i class="fas fa-fw fa-edit"></i>
                        </span>
                        <?php } else { ?>
                        <a class="btn btn-sm btn-outline-info" href="<?= base_url('periksa/ubahStatus/'.$p['id_poli'].'/'.$p['no_periksa']) ?>">
                           <i class="fas fa-fw fa-edit"></i> Ubah Status
                        </a>
                        <?php } ?>
                     </td>
                  </tr>
               <?php } ?>
            </table>
         </div>
      </div>
   </div>
</div>