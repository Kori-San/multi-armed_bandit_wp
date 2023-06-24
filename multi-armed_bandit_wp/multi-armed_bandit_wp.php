<?php
   /*
   Plugin Name: Multi Armed Bandit WordPress
   description: >-
  A Plugin that applies the Multi-Armed Bandit Algorithm into WordPress
   Version: 1.0
   Author: LE ROY Andy & EZZAYER Aymen
   License: MIT
   */

   /* 
      IU: - Rajouter des templates dans une liste 
          - Rentrer le nombre de tests à effectuer en Exploration
          
      Algorithme: - Quand on accéde à une nouvelle page on choisis un template en fonction du Bandit Manchot
                  - Quand un utilisateur clique sur un boutton / form / ect... on augmente la Reward de 1
                  - Quand l'utilisateur quitte la page on met à jour le poid et taux d'apparations des templates
                  - Apres n tests on rentre en exploitation et on affiche que le template qui "marche"
                  - Après 9 x n visites sur les pages on repasse en exploration
   */
?>