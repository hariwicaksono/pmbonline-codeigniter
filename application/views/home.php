<?php echo $header;?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

	<?php echo $navbar;?>	

	<div id="carousel" class="carousel slide mb-0" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel" data-slide-to="0" class="active"></li>
    <li data-target="#carousel" data-slide-to="1"></li>
    <li data-target="#carousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo base_url('assets/images/').$slide_1;?>" class="d-block" alt="<?php echo $slide_1_headline;?>">
      <div class="carousel-caption d-none d-md-block text-left">
	  	<h2 class="text-white"><?php echo $slide_1_headline;?></h2>
		<p><?php echo $slide_1_caption;?></p>
		<a class="btn btn-primary page-scroll" href="#prodi">Prodi Pilihan</a>
		<a class="btn btn-danger page-scroll" href="#daftar"><i class="fa fa-fw fa-send-o"></i> Daftar Sekarang</a> 
      </div>
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url('assets/images/').$slide_2;?>" class="d-block" alt="<?php echo $slide_2_headline;?>">
      <div class="carousel-caption d-none d-md-block">
	  <h2 class="text-white"><?php echo $slide_2_headline;?></h2>
		<p><?php echo $slide_2_caption;?></p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url('assets/images/').$slide_3;?>" class="d-block" alt="<?php echo $slide_3_headline;?>">
      <div class="carousel-caption d-none d-md-block text-left">
	  <h2 class="text-white"><?php echo $slide_3_headline;?></h2>
		<p><?php echo $slide_3_caption;?></p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container mt-3">
<?php echo $this->session->flashdata('error_daftar'); ?>
</div>

    <section id="intro" class="bg-white py-4">

        <div class="container">
		
            <div class="row wow fadeInUp" data-wow-delay="100ms" data-wow-duration="500ms">
			<div class="col-lg-12">
			<h1 class="h2 mb-3 text-center">Informasi</h1>
			</div>

            <div class="col-md-12">

			<div class="alert alert-<?php echo $site_theme;?>" role="alert">
			<strong><i class="fa fa-graduation-cap" aria-hidden="true"></i> Info Pendaftaran!</strong> Saat ini <u><?=$thak->ket ?></u> Penerimaan Mahasiswa Baru Tahun Akademik <?=$thak->tahun_ajaran ?>
			</div>

				<div class="panel card border-<?php echo $site_theme;?> text-left">
	            	<div class="panel-body card-body">
						<h4 class="mb-3 text-<?php echo $site_theme;?>"><i class="fa fa-bullhorn" aria-hidden="true"></i> Informasi Terbaru</h4>
	                        <ul id="gulung">
	                        <?php if ($informasi): ?>

	                        	 <?php foreach ($informasi as $info):
	                        		 $d=date('Y-m-d',strtotime($info->created_at));
	                        		 
	                        		 $date=date_create($d);
	                        		$n=date('Y-m-d');
	                        		 $now=date_create($n);
	                        		$diff=date_diff($date,$now);
		                       		
	                        		if ($diff->d < 1) {
	                        			$label='<span class="badge badge-info">New</span>';
	                        		}else{
	                        			$label='';
	                        		}
	                        	  ?>
	                        	 	<li class="news-item"><p><?=$info->info ?> <?=$label?></p></li>
	                        	 <?php endforeach ?>

	                        <?php else: ?>
	                        	<li class="news-item"><p>Tidak Ada Informasi Terbaru</p></li>	
	                        <?php endif ?>
                 
	                        </ul>
	                </div>
	               
            	</div>
                  
				</div>
                

            </div>
			
        </div>
    </section>

    <section id="prodi" class="bg-light py-4">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="100ms" data-wow-duration="500ms">
                <div class="col-lg-12">
					<h1 class="h2 mb-3 text-center">Program Studi</h1>
					<div class="card-columns">
					<?php foreach ($prodi1 as $prodi1): ?>
						<div class="card">	
						<div class="card-body">
						<h5 class="card-title"><?=$prodi1->jenjang ?> <?=$prodi1->nama_prodi ?></h5>
					</div>
					</div>		
					<?php endforeach; ?>
					</div>
                </div>
            </div>
        </div>
    </section>

    <section id="alur" class="bg-white py-4">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="100ms" data-wow-duration="500ms">
                <div class="col-lg-12">
                <h1 class="h2 mb-3 text-center">Alur Pendaftaran</h1>
                <img src="<?php echo base_url('assets/images/').$site_alurpmb;?>" class="img-responsive img-thumbnail" alt="">

            	</div>	
            </div>
        </div>
	</section>

    <section id="daftar" class="bg-light py-4">
	
        <div class="container">

            <div class="row">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="100ms" data-wow-duration="500ms">
                <h1 class="h2 mb-3">Formulir Pendaftaran</h1>
                	<?php if ($cek_reg === 'Ditutup'): ?>

					      <div class="alert alert-danger text-center">
			               <i class="icon fa fa-3x fa-warning"></i><br><strong>Maaf, Pendaftaran Belum Dibuka</strong>
			              </div>

					<?php else: ?>
					<hr/>
					<?=form_open_multipart('home/daftar','class=""') ?>
					<div class="form-group row">
							<label class="col-sm-2 col-form-label">Pilihan Prodi</label>
							<div class="col-sm-10" style="text-align:left">
								<?php foreach ($prodi as $prodi): ?>
								<div class="radio">
									<label>
										<input type="radio" name="prodi" value="<?=$prodi->kode_prodi ?>" required>
										<?=$prodi->jenjang ?> <?=$prodi->nama_prodi ?>
									</label>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">NISN</label>
							<div class="col-sm-10">
								<input type="text" name="nisn" class="form-control" placeholder="NISN" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Nama Lengkap</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
							</div>

							<div class="col-sm-4">
								<input type="text" class="form-control" name="nikktp" placeholder="Nomor NIK KTP" required>
							</div>

						</div>
						<div class="form-group row">
							
							<label class="col-sm-2 col-form-label">Agama</label>
							<div class="col-sm-4">
								<select class="form-control" name="agama" required>
									<option>Islam</option>
									<option>Kristen</option>
									<option>Katolik</option>
									<option>Hindu</option>
									<option>Budha</option>
								</select>
							</div>
							<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
							<div class="col-sm-4" style="text-align:left">
								<div class="radio" required>
									<label>
										<input type="radio" name="jenisKelamin" value="L" checked>
										Laki-laki
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="jenisKelamin" value="P">
										Perempuan
									</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Tanggal Lahir</label>
							<div class="col-sm-4">
								<input type="" class="form-control date-picker" name="tgl_lahir" placeholder="yyyy-mm-dd" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Alamat Domisili</label>
							<div class="col-sm-10">
								<textarea name="alamat" class="form-control" placeholder="Alamat Domisili" required></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Telp/Hp</label>
							<div class="col-sm-4">
								<input type="" name="hp" class="form-control" placeholder="Telepon/Hp" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">E-Mail</label>
							<div class="col-sm-4">
								<input type="email" name="email" class="form-control" placeholder="E-Mail">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Asal Sekolah</label>
							<div class="col-sm-4">
								<input type="text" name="sekolah" class="form-control" placeholder="contoh : SMAN 1 JAKARTA" required>
							</div>
							<label class="col-sm-2 col-form-label">Kab/Kota</label>
							<div class="col-sm-4">
								<input type="text" name="kota_sekolah" class="form-control" placeholder="contoh : JAKARTA" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Nilai UN</label>
							<div class="col-sm-2">
								<input type="nilai" name="nilai_un" class="form-control" data-mask="99.99" placeholder="00.00" required>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Foto</label>
							<div class="col-sm-10" style="text-align:left">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 250px; height: 150px;border: 1px solid #ddd"></div>
									<div>
										<span class="btn btn-default btn-file">
											<span class="fileinput-new btn btn-outline-primary"><i class="fa fa-camera"></i> Pilih gambar</span>
											<span class="fileinput-exists btn btn-outline-primary"><i class="fa fa-camera"></i> Ganti</span>
											<input type="file" name="userfile" required>
										</span>
										<a href="#" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash"></i> Hapus</a>
									</div>
								</div>
							</div>
						</div>
						<hr/>
						<div class="form-group row" style="text-align:left">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> DAFTAR</button>
								<button type="reset" class="btn btn-light">RESET</button>
							</div>
						</div>
					<?=form_close()  ?>

					<?php endif; ?>

                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="bg-dark text-white py-5">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="100ms" data-wow-duration="500ms">
			   <div class="col-md-12">
			<h1 class="h2 text-white mb-3">Panitia Pendaftaran</h1>	
			
				<h5 class="text-white mb-3">Untuk informasi lebih lanjut, hubungi Panitia Pendaftaran kami di:</h5>
			</div>

                <div class="col-md-7" id="map">	
				<style type="text/css" media="screen">
					iframe {
						width: 100%;
						max-height: 350px;
					}
				</style>
					<!-- Google Maps IFrame -->
					<?php echo $site_google_maps;?>
					<!-- -->
                </div>
				 <div class="col-md-5">	
				 <h4 class="text-white"><?php echo $site_title;?></h4>
				 <h6 class="mb-3"><?php echo $site_address;?></h6>
				<p><i class="fa fa-phone"></i> Telp.: <?php echo $site_phone;?><br/>
				<i class="fa fa-envelope-o"></i> Email: <?php echo $site_email;?><br/>
				<i class="fa fa-home"></i> Web: <a class="text-light" href="http://<?php echo $site_website;?>"><?php echo $site_website;?></a></p>
				<ul class="list-unstyled list-inline">
                    <li class="list-inline-item">
                        <a class="text-primary" href="<?php echo $site_facebook;?>"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-danger" href="<?php echo $site_instagram;?>"><i class="fa fa-instagram fa-2x"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-danger" href="<?php echo $site_youtube;?>"><i class="fa fa-youtube-play fa-2x"></i></a>
                    </li>
                    
                </ul>
				 </div>
            </div>
        </div>
    </section>

<?php echo $footer;?>
</body>
</html>
