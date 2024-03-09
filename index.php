<?php

$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tanchiwedia';
$pdo = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = $pdo->query("SELECT * FROM posts");
$posts = $query->fetchAll(PDO::FETCH_ASSOC);


require './includes/index.header.php';
?>

<main id="main">
  <section class="hire-me_body">
    <div class="hire-me_container">
      <a class="back"><i class="fa fa fa-angle-left"></i></a>
      <div class="contact-container">
        <div class="form_container">
          <form action="index.php" method="POST">
            <div class="phone_to_name">
              <div class="form-control">
                <label for="name" class="label zero">Name</label>
                <input type="text" name="name" id="name" class="inputs">
              </div>
              <div class="form-control">
                <label for="phone_number" class="one">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" class="inputs">
              </div>
            </div>
            <div class="form-control">
              <label for="email" class="two">Email</label>
              <input type="email" name="email" id="email" class="inputs" required>
            </div>
            <div class="form-control form-relative">
              <label for="contact_message" class="three">Your Message</label>
              <textarea name="contact_message" id="contact_message" cols="40" rows="8" required></textarea>
              <input type="submit" name="send" value="SEND" class="input-submit">
            </div>
            <span class="warning"></span>
          </form>
        </div>
        <div class="contact-detail">
          <a href="tel:+251912035350"><i class="fa fa-phone"></i><strong>Phone</strong></a>
          <a href="mailto:ephrem5350@gmail.com" target="_blank"><i class="fa fa-envelope"></i><strong>Email</strong></a>
          <a href="https://t.me/tanchwedia" target="_blank"><i class="fa fa-telegram"></i><strong>Telegram</strong></a>
        </div>
        <a href="___.pdf" download class="cv cv-first">Download CV <i class="fa fas fa-download"></i></a>
      </div>
  </section>
  <div class="main-helper">
    <div class="section-hero">
      <div class="hero-holder">
        <div class="flex-header">
          <img src="./skills/contact_me-photo.png" alt="" class="main-pic" />
          <h1 class="tanchiwedia tanchiwedia-eng">I am Ephrem</h1>
          <h1 class="tanchiwedia tanchiwedia-amh">(ታንችወዲያ)</h1>
          <div class="hold-who">
            <span>CINEMATOGRAPHER /</span><span>EDITOR /</span><span> GRAPHICS <span class="designer">DESIGNER</span></span>
          </div>
          <a class="hire-me">Hire Me <i class="fa fa-angle-right"></i> </a>
        </div>
        <p class="hero-para">
          I am an accomplished cinematographer, editor, and graphics
          designer, creating mesmerizing visuals and captivating narratives
          with precision and finesse. My work resonates with audiences,
          driven by innovation and a commitment to excellence.
        </p>
      </div>
    </div>
    <section>
    </section>
    <section id="section-one">
      <div class="hero">
        <h1 class="position-title">SOFTWARE SKILL</h1>
        <div class="rank">
          <div class="flex-rank first-rank">
            <img src="./skills/premier.png" alt="" width="40px" />
            <p>Adobe Premiere Pro</p>
            <hr />
            <img src="./skills/photoshop1.png" alt="" width="40px" />
            <p>Adobe Photoshop</p>
            <hr />
            <img src="./skills/ae.png" alt="" width="40px" />
            <p>Adobe After Effect</p>
            <hr />
            <img src="./skills/adobe-illu.png" alt="" width="40px" />
            <p>Adobe Illustator</p>
            <hr />
          </div>
          <div class="flex-rank second-rank">
            <img src="./skills/davincii.png" alt="" width="40px" />
            <p>Davinci Resolve 18/7</p>
            <hr />
            <img src="./skills/blender copy.png" alt="" width="75px" class="blender" />
            <p>Blender 3D</p>
            <hr />
            <img src="./skills/ms off.png" alt="" width="40px" />
            <p>Ms Office</p>
            <hr />
            <img src="./skills/lightroom.png" alt="" width="40px" />
            <p>Adobe Lightroom</p>
            <hr />
          </div>
        </div>
      </div>
    </section>

    <section id="gallery">
      <div class="popup-container closing-popup">
        <div class="popup-content">
          <!-- <button class="prev"><</button> -->
          <a class="close-popup"><i class="fa fa-close"></i></a>
          <img alt="" class="popup-active" />
          <!-- <button class="next">></button> -->
          <!-- ? work on next and prev buttons someday  -->
        </div>
      </div>
      <h2 class="position-title">GALLERY</h2>
      <div class="gallery-container">
        <div class="gallery-item">
          <?php foreach ($posts as $post) : ?>
            <div class="img-source">
              <img src="<?php echo $post['photo'] ?>" alt="<?php echo $post['description'] ?>" class="nested-imgs <?php echo $post['is_landscape'] ? 'landscape' : '' ?>" />
              <div class="img-desc">
                <div class="description">
                  <span class="exposure" data-exposure="1/160"><strong></strong> <?php echo $post['exposure'] ?>
                  </span>
                  <span class="focus" data-focus="f/4"><strong></strong> <?php echo $post['focus'] ?></span>
                  <span class="focal-length" data-focal_length="93mm"><strong></strong> <?php echo $post['focal_length'] ?></span>
                  <span class="device" data-device_model="5D Mark III"><strong></strong> <?php echo $post['device_model'] ?></span>
                </div>
                <div class="icon-hold">
                  <a class="like-pic"><i class="fa fa-thumbs-o-up"></i></a>
                  <a class="expand-popup"><i class="fa fa-expand"></i></a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="videos">
          <div class="videos-container">
            <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/H6ltDWy84XA?controls=0&amp;start=8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/U7hIfjN3E8Y?controls=0&amp;start=8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
          </div>
          <p class="more-videos">More Videos Soon!</p>
        </div>
        <a class="hire-me hire-me_bottom">Hire Me <i class="fa fa-angle-right"></i>
        </a>
    </section>
  </div>
  <div class="current-position" id="section-who">
    <h2 class="position-title">WORK EXPERIENCE</h2>
    <div class="position-container">
      <div class="experience-doing">
        <strong class="year">2010 - 2011</strong>
        <div class="span-flexer">
          <span>EDITOR & CAMERAMAN</span>
          <span>Geni Film Production / Addis Ababa</span>
          <div class="experience-description">
            <p class="something-about_it">
              My work experience there was truly remarkable, surpassing all
              expectations and leaving an indelible impression on me. It
              provided invaluable opportunities for growth, both
              professionally and personally, and equipped me with a diverse
              skill set.
            </p>
            <p class="ref">
              <span class="ref-underline">Reference</span>: Mr. Ermias
              Mekonnen / Manager
            </p>
            <span class="phone-num">+251 910 557 166</span>
          </div>
        </div>
      </div>

      <div class="experience-doing">
        <strong class="year">2012-2015</strong>
        <div class="span-flexer">
          <span>EDITOR, CAMERAMAN, GRAPHICS DESIGNER</span>
          <span><a href="https://www.labamedia54.com" target="_blank" class="laba-media">
              Laba Media</a>
            & Communications / Addis Ababa</span>

          <div class="experience-description">
            <p class="something-about_it">
              I initially joined the company as a contract employee, which
              served as a stepping stone to immerse myself in the
              organization's dynamic work culture. Over time, my dedication
              and commitment led to a transition into a full-time role,
              solidifying my place within the team. This progression allowed
              me to deepen my understanding of the company's vision and
              values, and further contributed to my professional growth and
              development.
            </p>
            <p class="ref">
              <span class="ref-underline">Reference</span>: Mrs. Ejigayehu
              Kassa / D. Manager
            </p>
            <span class="phone-num">+251 911 233 425</span>
          </div>
        </div>
      </div>

      <div class="experience-doing more-doing">
        <strong class="year about-me">ABOUT ME</strong>
        <div class="span-flexer">
          <span>
            CERTIFIED
            <a href="https://tomtrainingcenter.com/" target="_blank">
              @TOM
            </a>
            VIDEOGRAPHY AND PHOTOGRAPHY</span>
          <span>Certified <a href="">@DOM</a> Adobe After Effect</span>
          <div class="experience-description">
            <p class="something-about_it">
              I have edited many music videos and movies
            </p>
            <p class="something-about_it">
              Certified<a href="https://satcomethiopia.com/" target="_blank">
                @SATCOM</a>
              Electronic Maintenance
            </p>
            <p class="something-about_it">
              I'm currently enrolled at
              <a href="https://www.ftveti.edu.et/" target="_blank"><abbr title="Technical and Vocational Training
                    Institute">
                  (TVTI)</abbr></a>, Learning Electrical engineering, 4th Year.
            </p>
            <p class="something-about_it">On-site Building Management.</p>
            <p class="something-about_it">IT support.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require './includes/index.footer.php'; ?>