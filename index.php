  <?php 
        include_once 'Views/base.php';
        startblock('main') 
  ?>

  <h2 class = "introHeading">Haarlem Festival - 2021</h2>
  <p class="introduction">
 famous museums, shops,
restaurants and the beach around the corner: welcome to Haarlem,
the city that has everything. From hidden courtyards from bygone times to trendy concept stores. From medieval church to terrace on the water. From Dutch Masters to French star chefs. From antique market to pop concert. Fancy a memorable day out? Visit Haarlem and be surprised by the sights, boutiques and picturesque squares, by the old and contemporary artists, the Burgundian atmosphere and the rich history.
</p>
       <section class="flex-container-HaarlemIndex">

          <article class="article1">
              <div class = "eventImg">
                <img src="Img/d22.jpg" alt="product 1"  title ="image of rubiks  cub"/>
            </div>
        <h3>Dance</h3>
        <p class = "introParagraph">
            type : french,dutch, german
            location : holland
            rating : 5 stars
            opening time : 15:30 - 18:10
       </p>
       <a href=/Views/dance/dance.php class = 'btn btn-md' role='button'>Book now</a>
           </article>

           <article class="article1">
           <div class = "eventImg">
               <img src="Img/jazz1.jpg" alt="product 2" title ="image of castle game"/>
            </div>
       <h3>Jazz</h3>
       <p class = "introParagraph">
            type : french,dutch, german
            location : holland
            rating : 5 stars
            opening time : 15:30 - 18:10
       </p>
       <a href='/Views/jazz/jazz.php' class = 'btn btn-md' role='button'>Book now</a>
           </article>

           <article class="article1">
           <div class = "eventImg">
               <img src="Img/h.jpg" alt=" product 3"  title ="image of super mario"/>
            </div>
       <h3>History</h3>
       <p class = "introParagraph">
            type : french,dutch, german
            location : holland
            rating : 5 stars
            opening time : 15:30 - 18:10
       </p>
       <a href='#' class = 'btn btn-md' role='button'>Book now</a>
           </article>

           <article class="article1">
           <div class = "eventImg">
               <img src="Img/food.jpg" alt=" product 4"  title ="image of poker"/>
            </div>
       <h3>Food</h3>
       <p class = "introParagraph">
            type : french,dutch, german
            location : holland
            rating : 5 stars
            opening time : 15:30 - 18:10
       </p>
       <a href='#' class = 'btn btn-md' role='button'>Book now</a>
           </article>
<?php endblock('main') ?>
