<div class="container">
   <div class="row">
      <div class="col-sm-12 col-md-11">
         <div class="table-reponsive full-width">
            <table class="table table-bordered table-striped table-hover" id="table-datatable">
               <tr>
                  <td>No Periksa</td>
                  <td>Tanggal Daftar</td>
                  <td>ID User</td>
                  <td>ID Poli</td>
                  <td>Tanggal Selesai</td>
                  <td>Tanggal Pemeriksaan</td>
                  <td>Terlambat</td>
                  <td>Status</td>
                  <td>Pilihan</td>
               </tr>

               <?php foreach($periksa as $pr) { ?>
                  <tr>
                     <td><?= $pr['no_periksa'] ?></td>
                     <td><?= $pr['tgl_periksa'] ?></td>
                     <td><?= $pr['id_user'] ?></td>
                     <td><?= $pr['id_poli'] ?></td>
                     <td><?= $pr['tgl_kembali'] ?></td>
                     <td>
                        <?= date('Y-m-d') ?>
                        <input type="hidden" name="tgl_selesai" id="tgl_selesai" value="<?= date('Y-m-d') ?>">
                     </td>
                     <td>
                        <?php 
                           $tgl1 = new DateTime($pr['tgl_kembali']);
                           $tgl2 = new DateTime();

                           if (date('Y-m-d') > $pr['tgl_kembali']) {
                              $selisih = $tgl2->diff($tgl1)->format("%a");  
                           } else {
                              $selisih = 0;
                           }
                           
                           echo $selisih;
                        ?> Hari
                     </td>
                     <?php if($pr['status'] == 'Periksa') { $status ='warning'; } else { $status = 'secondary'; } ?>
                     <td><i class="<?= "btn btn-outline-".$status ?>"><?= $pr['status'] ?></i></td>
                     <td nowrap>
                        <?php if($pr['status'] == 'Selesai') { ?>
                        <span class="btn btn-sm btn-outline-secondary">
                           <i class="fas fa-fw fa-edit"></i>
                        </span>
                        <?php } else { ?>
                        <a class="btn btn-sm btn-outline-info" href="<?= base_url('periksa/ubahStatus/'.$pr['id_poli'].'/'.$pr['no_periksa']) ?>">
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