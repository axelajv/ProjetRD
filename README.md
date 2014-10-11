ProjetRD
========

#### Université Évry - Projet VT2 bis
Le <a href="https://github.com/edmondsnadane/Projet-R-D.git" title="projet VT2">projet VT2</a> consiste en la refonte ergonomique du site http://edt.univ-evry.fr/.<br>
<b>Ce projet VT2 bis vise à proposer une évolution supplémentaire : la synchronisation d'agendas sur des postes clients.</b> 

### OBJECTIFS 
* La <b>mise en place d'un serveur CalDAV</b> (http://www.radicale.org/) pour les enseignants, les groupes d'étudiant, lles salles, <i>(le matériel ?)</i>.
    - Ce serveur doit être sécurisé via <b>utilisation du protocole HTTPS</b>
    - L'authentification doit être supporté par le <b>module WSGI</b> (composant Apache mod_wsgi).
* Ajouter un nouveau service à l'application Web VT :
    - Accès à la récupération d'EdT au format ICS par login/mdp
* Mettre à jour l'IHM en apportant davantage d'utilisabilité et d'ergonomie
    - usage <b>Bureau / Tablette / Mobile</b>
    - <b>X-browser</b> (FF OS, iOS, Chrome)

### INFORMATIONS
Pour toutes informations supplémentaires, veuillez consulter notre <a href="https://github.com/indydedeken/ProjetRD/wiki">Wiki</a>.
