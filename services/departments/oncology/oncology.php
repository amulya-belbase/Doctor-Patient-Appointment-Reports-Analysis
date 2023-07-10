
<?php
      include "../../dbconn.php";

// to get the username
$list = "SELECT * FROM doctor_list
                WHERE department = 'Oncology'";
$result = mysqli_query($conn,$list); // passing the sql code through conn into the database
?>

<!-- A example of static department page of Oncology, can be modified. Other department pages are yet to be added.  -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Oncology Department</title>
    <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
      rel="stylesheet">
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./oncology.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">
  </head>
  <body>

    <!--
      - Header for specialists
    -->

    <header>
      <a href="../../../index2.html" class="logo">
        <img src="../../../assets/images/logo.svg" width="136" height="46" alt="Doclab home">
      </a>
      <nav class="navbar">
          <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#ourdoctors">Our Doctors</a>
            </li>
            <li><a href="#ourfacility">Our Facility</a>
            </li>
            <li><a href="#ourresearch">Our Research</a></li>
            <li><a href="#contactus">Contact Us</a></li>
            <li><input type="button" onclick="location.href='../../appointment.php';" value ="For appointments" class ="button"></li>
          </ul>
        </nav>
    </header>
    <div class="roll"  id="home">
      <p>New In Oncology:</p>
      <marquee direction="left" class="marquee">
        New developments in the field of liver research, scientists have tested their new drug in rats and have seen satisfactory results. 30 new MRI machines donated by the state government.
      </marquee>
    </div>

    <!-- Slideshow container -->
    <div class="slideshow-container">

      <!-- Full-width images with number and caption text -->
      <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="./oncology 1.jpg" style="width:100%">
        <div class="text">Our state-of-the-art facility</div>
      </div>

      <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="./oncology 2.jpg" style="width:100%">
        <div class="text">Our experienced faculty</div>
      </div>

      <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="./oncology 3.jpg" style="width:100%">
        <div class="text">Our Research</div>
      </div>

      <!-- Next and previous buttons -->
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>


    <!-- The dots/circles -->
    <div style="text-align:center" class="dotsection">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
    </div>
    <br>
    <div class="description">
      <p>Oncology is a branch of medicine that deals with the study, treatment, diagnosis and prevention of tumors. A medical professional who practices oncology is an oncologist. The name's etymological origin is the Greek word ὄγκος (ónkos), meaning "tumor", "volume" or "mass". Oncology is concerned with:
        <br><ul>
    <li>The diagnosis of any cancer in a person (pathology)</li>
    <li>Therapy (e.g. surgery, chemotherapy, radiotherapy and other modalities)</li>
    <li>Follow-up of cancer patients after successful treatment</li>
    <li>Palliative care of patients with terminal malignancies</li>
    <li>Ethical questions surrounding cancer care</li>
    <li>Screening efforts:</li>
    <ul>
      <li>of populations, or</li>
      <li>of the relatives of patients (in types of cancer that are thought to have a hereditary basis, such as breast cancer)</li>
    </ul>

</ul>  </p>
    </div>
    <div class="diagnosis">

      <h2>Diagnosis</h2><br>
      <p>Medical histories remain an important screening tool: the character of the complaints and nonspecific symptoms (such as fatigue, weight loss, unexplained anemia, fever of unknown origin, paraneoplastic phenomena and other signs) may warrant further investigation for malignancy. Occasionally, a physical examination may find the location of a malignancy.
          Diagnostic methods include:</p>
<ul>
    <li>Biopsy or resection</li>
    <li>Endoscopy</li>
    <li>X-rays, CT scanning, MRI scanning, ultrasound and other radiological techniques to localise and guide biopsy.</li>

    <li>
Scintigraphy, single photon emission computed tomography (SPECT), positron emission tomography (PET) and other methods of nuclear medicine to identify areas suspicious for malignancy.</li>
    <li>Blood tests, including tumor markers, which can increase the suspicion of certain types of cancers.</li>
    </ul>
    <br>
    <p>Apart from diagnoses, these modalities (especially imaging by CT scanning) are often used to determine operability, i.e. whether it is surgically possible to remove a tumor in its entirety.
<br><br>
Currently, a tissue diagnosis (from a biopsy) by a pathologist is essential for the proper classification of cancer and to guide the next step of treatment. On extremely rare instances when this is not possible, "empirical therapy" (without an exact diagnosis) may be considered, based on the available evidence (e.g. history, x-rays and scans.)
<br><br>
On very rare occasions, a metastatic lump or pathological lymph node is found (typically in the neck) for which a primary tumor cannot be found. However, immunohistochemical markers often give a strong indication of the primary malignancy. This situation is referred to as "malignacy of unknown primary", and again, treatment is empirical based on past experience of the most likely origin.</p>

    </div>


    <div class="users" id="ourdoctors">
        <h2>Our Doctors</h2>
        <?php
            while(($row = $result->fetch_assoc()) != false){   // until assosiative array is empty (false)
              ?>  <div class="card"><?php
              $dname = $row['name'];
              $hname = $row['hospital'];
              $experience = $row['experience'];
              $depart = $row['department'];
        ?>
            <img src="../../2.png">
            <h4>Doctor's Name: <?php echo $dname;?></h4>
            <p>Hospital: <?php echo $hname;?></p>
            <p>Department: <?php echo $depart;?></p>
            <p>Experience</p>
            <div class="per">
                <table>
                  <tr>
                    <td><span><?php echo $experience;?> Years</span></td>
                  </tr>
                </table>
            </div>
          </div>
        <?php
        }  ?>
</div>
        <div class="gallery" id="ourfacility">
           <h2 class="section-gallery headline-md text-center" data-reveal="bottom">Our Facility</h2>
          <div class="main-gallery" data-reveal="bottom">
              <div class="inner-gallery">
                  <img src="onc_facility_1.jpg" alt="">
              </div>

              <div class="inner-gallery">
                  <img src="onc_facility_5.jpg " alt="">
              </div>

              <div class="inner-gallery">
                  <img src="onc_facility_3.jpg" alt="">
              </div>

              <div class="inner-gallery">
                  <img src="onc_facility_4.jpg" alt="">
              </div>

              <div class="inner-gallery">
                  <img src="onc_facility_2.jpg" alt="">
              </div>

              <div class="inner-gallery">
                  <img src="onc_facility_6.jpg" alt="">
              </div>
          </div>
        </div>


          <div class="container" id="ourresearch">
            <h2 class="h2ourresearch">Our Research</h2>
              <div class="articles">
                  <div class="individualarticles" id="firstarticle">
                    <h3 class="headline-sm card-title">Could intermittent fasting reduce breast cancer?</h3>
                    <time class="date" datetime="2023-01-12">12 January, 2023</time>
                    <p class="card-text">
                      Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                      labore et dolore magna aliquyam erat
                    </p>
                    <a href="#" class="link">Read More -></a>
                  </div>
                  <div class="individualarticles">
                    <h3 class="headline-sm card-title">Protien development in malignant tumor.</h3>
                    <time class="date" datetime="2023-04-28">28 April, 2023</time>
                    <p class="card-text">
                      Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                      labore et dolore magna aliquyam erat
                    </p>
                    <a href="#" class="link">Read More -></a>
                  </div>
                  <div class="individualarticles" id="lastarticle">
                    <h3 class="headline-sm card-title">Palliative care for stage-4 patients.</h3>
                    <time class="date" datetime="2023-03-19">19 March, 2023</time>
                    <p class="card-text">
                      Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                      labore et dolore magna aliquyam erat
                    </p>
                    <a href="#" class="link">Read More -></a>
                  </div>
              </div>
            </div>



            <footer>
                <div class="footercontainer" id="contactus">
                  <div class="footerelement">
                    <div class="leftmap">
                      <h2>Visit Us:</h2>
                      <div class="map">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3058.1510923371184!2d116.31019991474638!3d39.96037449119218!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x35f0516f2a5a7029%3A0x17b39135c61f62cc!2sBeijing%20Institute%20of%20Technology!5e0!3m2!1sen!2sau!4v1681052335324!5m2!1sen!2sau" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <div class="location">
                          <h3>Location details:</h3>
                          <p>北京市海淀区魏公村中关村大街5号. <br>邮政编码: 100811.</p>
                        </div>
                      </div>
                    </div>
                    <div class="rightfooter">
                      <div class="contactfooter">
                        <h2>Contact details: </h2>
                        <p>Phone No.: <a href="#">+01-111122233</a></p>
                        <p>Administration email: <a href="#">abcd@abcd.com</a></p>
                        <p>Faculty email: <a href="#">abcd@abcd.com</a></p>
                        <p>Fax: <a href="#">+01-111122233</a></p>
                      </div>
                      <div class="allrights">
                        <h2>All rights reserved.</h2>
                        <p>DocLab© AB2023 | Amulya</p>
                      </div>
                    </div>
                  </div>
                </div>
            </footer>


<script src="script.js"></script>
  </body>
</html>
