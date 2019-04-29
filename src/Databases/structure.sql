drop database wildPost;
create database wildPost;

USE wildPost;


CREATE TABLE articles
(
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
title VARCHAR(100) NOT NULL,
articleDate DATE NOT NULL,
author VARCHAR(50) NOT NULL,  
category VARCHAR(50) NOT NULL, 
content text NOT NULL,
tag VARCHAR(30),
topArt BOOL NOT NULL,
published BOOL NOT NULL,
imageName VARCHAR(50));

INSERT INTO `articles` VALUES (3,'Une étude montre que dormir nu met tout le dortoir mal à l’aise',
	'2019-04-29','La rédaction','1',
	'<p><strong>Une étude parue cette semaine a dévoilé que le fait de dormir nu présentait le risque de mettre 
	l’entièreté du dortoir mal à l’aise.</strong></p>\r\n<p><em>« Les résultats sont clairs et nets. Nous avons 
	demandé à plusieurs personnes de dormir entièrement nues, et dans chaque cas, cela avait pour effet de rendre 
	tous les occupants de leur dortoir mal à l’aise »</em>, explique l’un des chercheurs à l’origine de l’étude. 
	Si le niveau de malaise varie en fonction de l’âge et du physique du sujet, les résultats montrent qu’il est 
	presque impossible de dormir nu sans créer une sensation de gêne globale dans le dortoir. Cette sensation augmente
	 considérablement lorsque certains facteurs supplémentaires s’ajoutent, comme par exemple le ronflement ou les 
	 pénis non-circoncis.</p>\r\n<p>Nombreux sont en France les gens qui ont eu de mauvaises expériences en
	  présence d’un dormeur nu, comme nous le montrent les quelques témoignages qui suivent.<br />Daniel, 
	  qui n’avait jusqu’alors jamais vu d’érection de sa vie autre que la sienne, ne dort plus tranquillement 
	  depuis qu’il s’est retrouvé dans la même chambre d’auberge de jeunesse qu’un voyageur sans pudeur.
	   <em>« Il dormait nu comme si c’était normal. Cela m’a beaucoup gêné de voir quelqu’un d’aussi à 
	   l’aise avec son propre corps »</em>, raconte-t-il.<br /><em>« Je ne le verrai plus jamais de 
	   la même façon »</em>, révèle quant à elle une femme en évoquant le jour où elle a vu son mari 
	   entièrement nu dans leur lit.</p>\r\n<p>Qui plus est, la moitié des gens qui dorment nus affirment 
	   ressentir une sensation de manque car ils ne peuvent pas porter leur pyjama préféré.</p>','',
	   1,1,'assets/images/image0068647001556542475.jpeg'),(4,'Parti au Népal pour un voyage d’introspection, 
	   il se rend enfin compte qu’il est un connard','2019-04-29','Jean Michel','1','<div class=\"intro\">\r\n<p>
	   <strong>Sakhuwanankarkatti, Népal – Un Français de 27 ans parti dans ce pays enclavé de l’Himalaya pour
	    se découvrir lui-même a été choqué de se rendre compte qu’il est en fait un gros connard.</strong>
	    </p>\r\n</div>\r\n<p>Gauthier, qui gagne sa vie en demandant aux gens dans la rue de donner de l’argent 
	    à une association, est encore sous le choc après avoir découvert les résultats de son voyage d’introspection.
	     <em>“Je suis vraiment déçu”</em>, explique le voyageur ayant pris deux-cent-soixante-dix-sept selfies 
	     en une semaine de voyage. <em>“Je m’attendais juste à trouver la paix intérieure ou un truc bouddhiste
	      dans le genre”</em>, précise-t-il.<em> “Je ne savais pas que l’introspection consistait à se remettre 
	      en question.”</em></p>\r\n<p><em>“J’ai supprimé une photo de moi avec un enfant de la rue sur Instagram 
	      parce qu’elle avait pas reçu assez de likes”</em>, explique le jeune homme en donnant un exemple de ce 
	      qui prouve, selon lui, qu’il est un connard. <em>“Je suis vegan mais j’achète des vêtements fabriqués 
	      par des enfants”</em>, poursuit-il en donnant un exemple d’hypocrisie dont il est coupable depuis des 
	      années.</p>\r\n<p><em>“Je me rends compte que si mes relations amoureuses n’ont pas fonctionné, c’est
	       parce que je ne sais pas communiquer, et je compte me faire pardonner”</em>, avoue-t-il avant d’insulter 
	       une de ses ex-compagnes derrière son dos.</p>\r\n<p><em>“Au moins, cette révélation aura fait de moi
	        une meilleure personne</em>”, termine le ‘backpacker’ qui s’est filmé sur Facebook live en train de 
	        donner quelques roupies népalaises à un mendiant, avant de se prendre une énorme cuite dans un bar à 
	        strip-tease employant probablement des adolescentes.</p>\r\n<p>Une erreur commise à la publication de 
	        l’article a été corrigée. Le nom du village est Sakhuwanankarkatti, et non pas Sakhuwanakarkati.</p>',
	        '',0,1,'assets/images/image0678171001556542484.jpeg'),(5,'Malgré les avertissements, il court à la piscine
	         : 86 morts','2019-04-29','Jean Michel','1','<div class=\"intro\">\r\n<p><strong>Villejuif – Ce mardi, 
	         un individu au bord d’une piscine se serait mis à courir malgré l’interdiction et aurait ainsi provoqué 
	         la mort de 86 personnes.</strong></p>\r\n</div>\r\n<p> Le coureur fou aurait percuté plusieurs personnes
	          avant de tomber dans le bassin où se déroulait un cours d’aquagym, déclenchant ainsi une vague d’accidents
	           allant jusqu’à faire des victimes au <em>« café de la plonge »</em> où se trouvaient principalement des 
	           mamans accompagnatrices qui n’étaient pas d’humeur à nager. L’une d’elles, seulement légèrement blessée, est la mère du baigneur responsable du carnage. <em>« J’en reviens pas que mon fils a fait ça. Personne n’a rien vu venir. Depuis tout petit il n’avait jamais couru à la piscine »</em>, a-t-elle raconté avec douleur.<em> « J’aurais dû savoir qu’il y avait un problème quand j’ai vu qu’il avait mis un short de bain »,</em> précise-t-elle en rappelant que ceux-ci étaient strictement interdits.</p>\r\n<p>François Hollande est allé sur place cet après-midi pour rendre hommage aux victimes. <em>« Il est important de rappeler que courir à la piscine n’est pas dans nos valeurs républicaines »</em>, a-t-il affirmé avec conviction, en promettant d’augmenter le nombre de maîtres nageurs dans les piscines publiques d’ici la fin de son mandat, ce qui est susceptible d’augmenter sa cote de popularité. Il a également fait savoir que toutes les piscines seront fermées jusqu’à la semaine prochaine. Manuel Valls quant à lui, candidat à la primaire de la gauche après avoir quitté son poste de premier ministre, affirme être<em> « le candidat des baigneurs. »</em></p>','',0,1,'assets/images/image0200924001556542493.jpeg'),(6,'Julie Gayet se trompe de scooter et couche avec un livreur de pizzas','2019-04-29','Jean Michel','1','<div class=\"intro\">\r\n<p><strong>La semaine dernière, le magazine Closer faisait état d’une relation entre le président François Hollande et l’actrice française Julie Gayet. Dans l’enquête de la revue people, nous apprenions que le chef de l’Etat se rendait régulièrement en véhicule motorisé à deux roues à l’appartement de la comédienne. Aujourd’hui c’est le site Public.fr qui nous relate un nouvel épisode de ce feuilleton.</strong></p>\r\n</div>\r\n<p dir=\"ltr\" style=\"text-align: justify;\">La semaine dernière, le magazine <em>Closer</em> faisait état d’une relation entre le président François Hollande et l’actrice française Julie Gayet. Dans l’enquête de la revue people, nous apprenions que le chef de l’Etat se rendait régulièrement en véhicule motorisé à deux roues à l’appartement de la comédienne. Aujourd’hui c’est le site <em>Public.fr</em> qui nous relate un nouvel épisode de ce feuilleton.</p>\r\n<p dir=\"ltr\" style=\"text-align: justify;\">Selon le média people, Julie Gayet aurait commis une erreur des plus insolites hier soir tard dans la nuit. Alors qu’elle descendait de chez elle pour rejoindre M. Hollande censé venir la chercher, l’actrice se serait trompée de personne et aurait embarqué à bord d’un scooter Domino’s Pizza, prenant le simple livreur pour le président de la République. « <em>Elle s’est précipitée en courant sans regarder de qui il s’agissait. Peut-être pour éviter les paparazzis. Résultat: le conducteur l’a emmenée avec lui. M. Hollande est arrivé quelques minutes après et a attendu au moins 45 minutes en bas de chez elle avant de repartir</em> », relate le site.</p>\r\n<p dir=\"ltr\" style=\"text-align: justify;\">Une méprise qui aura sans doute provoqué la déception de François Hollande mais qui aura au moins fait un heureux, à savoir le fameux livreur de pizzas. Présent sur Twitter, ce dernier a posté ce matin un selfie de lui-même aux côtés de Julie Gayet visiblement endormie dans son lit, le tout accompagné du commentaire suivant : « <em>C’est le meilleur pourboire qu’on m’ait jamais donné.</em> »</p>','',0,1,'assets/images/image0118048001556542504.jpeg'),(7,'Selon une étude, les gens qui disent « malaisant » ou « gênance » sont les mêmes','2019-04-29','Jean Michel','1','<p><strong>Le dernier rapport de l’Institut du Langage est formel : les personnes qui osent employer le mot « malaisant » pour exprimer un malaise, et ceux qui utilisent « gênance » pour décrire une simple gêne, sont les mêmes.</strong></p>\r\n<p> </p>\r\n<p><em>« Cela fait plus de 6 mois qu’on travaille dessus comme des acharnés »</em> raconte Sylvie Hauguel, responsable du pôle «<em> Néologismes, barbarismes et imbécilités » </em>de l’Institut. « On estime que ces mots ont émergé en 2015-2016. On ne sait pas pourquoi ils se sont répandus, ce qu’ils avaient de spécial, mais le fait est là : de plus en plus de personnes les utilisent chaque jour : pas uniquement pour faire rire leurs amis, mais à leur travail ou sur les réseaux sociaux, ce qui est beaucoup plus inquiétant. Certains pensent vraiment que ces mots existent, et ne sont même pas conscients de leur ânerie. »</p>\r\n<p>S’en suivent des mois d’observation intensive sur les sujets. Dès le départ, il semble que les personnes qui utilisent <em>« malaisant »</em> ou <em>« gênance »</em> ont des points communs. « Ils travaillent dans le secteur tertiaire et pensent qu’ils sont plus malins que les autres. C’est un point qu’on retrouve systématiquement » précise Sylvie Hauguel. <em>« Petit à petit, on s’est aperçus que les points communs se multipliaient et notre conclusion est tombée, comme une évidence : ce sont les mêmes personnes. L’un ne va pas sans l’autre : celui ou celle qui utilise « malaisant » utilisera automatiquement le mot « gênance », c’est une maladie qui a plusieurs symptômes cumulatifs. »</em></p>\r\n<p>Un traitement est à l’étude pour éradiquer le phénomène, et on peut espérer une solution médicamenteuse d’ici un à deux ans.</p>','',0,1,'assets/images/image0176984001556542514.jpeg'),(8,'Il offre son tabouret à l’invité le moins important','2019-04-29','Jean Michel','1','<p><strong>Lors de sa soirée dans son appartement, Loïc a décidé d’offrir son tabouret à l’invité qui le laissait le plus indifférent.</strong></p>\r\n<p> </p>\r\n<p><em>« Seuls les invités qui me sont chers ont droit aux chaises »</em>, explique l’hôte qui garde toujours au moins un tabouret sous la main afin de l’offrir aux invités qui n’ont absolument aucun impact sur sa vie. <em>« Ceux qui sont là uniquement car je n’ai pas osé les refuser n’ont droit qu’aux tabourets. Telle est la règle »</em>, poursuit l’homme qui n’a aucun de mal à se faire des amis qui pourraient mourir sans qu’il ne le remarque jamais. <em>« A vrai dire, il y a un certain nombre de règles que j’applique dans mon humble demeure. Par exemple, je ne précise jamais aux invités s’ils doivent ou non apporter de la nourriture et des boissons »</em>, poursuit l’organisateur de la soirée qui, lui, reçoit systématiquement un confortable fauteuil lorsqu’il est invité chez des gens.</p>\r\n<p><em>« J’accepte toujours le siège inconfortable qui m’est assigné »</em>, raconte l’homme au tabouret, qui a l’habitude d’être assez peu considéré en tant qu’hôte. <em>« En fait, je n’ai pas vraiment d’amis proches. Quand je vais chez quelqu’un, c’est tout le temps l’ami d’un ami ou la cousine d’un collègue de bureau qui ne connaît même pas mon nom mais m’invite quand même par politesse. Ou par pitié, je ne sais pas »</em>, précise l’invité le moins apprécié alors qu’il regrette encore une fois d’être venu.</p>\r\n<p>Des témoins affirment qu’il s’agissait d’un tabouret minuscule pour enfants, aux couleurs mauve clair et décoré de paillettes.</p>','',0,1,'assets/images/image0250161001556542524.jpeg'),(9,'Nathalie Loiseau affirme qu’elle ignorait que LaREM était un parti de droite','2019-04-29','Jean Michel','1','<p><strong>Paris – Après les révélations de Médiapart sur sa présence dans sa jeunesse sur une liste d’extrême-droite, Nathalie Loiseau doit désormais se justifier de sa présence sur la liste aux Européennes de La République En Marche, une liste pourtant classée à droite. Reportage.</strong></p>\r\n<p> </p>\r\n<p>Elle soutient mordicus qu’elle n’a jamais su que ce parti était de droite. <em>« On m’a toujours dit que La République En Marche n’était pourtant ni de gauche ni de droite, je n’avais aucun moyen d’en douter jusqu’à aujourd’hui »</em> affirme-t-elle. Toujours selon elle, la dérive droitière de ce parti serait le fait d’autres militants et membres du parti comme Christophe Castaner ou Aurore Bergé qui par leurs actions postérieures ont fait évoluer le parti vers un alignement avec une droite dure et identitaire. <em>« Quand je me suis inscrite à En Marche!, c’était par engagement à gauche » </em>souligne-t-elle, ce que réfutent des analystes qui ont suivi l’émergence du parti En Marche, estimant que le parti avait toujours été à droite et ce depuis le début. Durant sa conférence de presse, Nathalie Loiseau a aussi affirmé qu’elle ignorait qu’elle deviendrait députée européenne si elle était élue <em>« Encore une invention perfide d’Edwy Plenel »</em> a-t-elle répété.</p>','',0,1,'assets/images/image0429616001556542537.jpeg'),(10,'Pollution – Des micro-plastiques déjà détectés à l’intérieur du trou noir M87*','2019-04-29','Jean Michel','2','<p><strong>La fête aura été de courte durée. La joie de la découverte et de la première photo du trou noir M87* a été contrebalancée par les premiers signes d’une pollution massive aux micro-plastiques au sein même du trou noir. Reportage.</strong></p>\r\n<p> </p>\r\n<p>La faute à la diffusion massive des photos sur internet et sur les réseaux sociaux qui a provoqué un afflux massif de visiteurs aux abords du trou noir. Conséquence : le site est déjà très pollué, plusieurs agrégats stellaires vont devoir être fermés au public le temps que les responsables de l’agence spatiale européennes les nettoient. <em>« C’est dramatique, on pensait que les gens seraient un peu plus responsables »</em> explique Katie Bouman la scientifique qui a elle-même permis la photographie du trou noir. «<em> Je lance un appel, ne venez pas saccager le trou noir, soyez respectueux de votre environnement »</em>. On dénombre aussi plusieurs décès de personnes qui essayant de faire un selfie en se penchant sur le bord du trou noir ont vu leur matière irrémédiablement aspirée à l’intérieur et disparaître à jamais dans l’espace et le temps. En outre, on apprenait que des colleurs d’affiches de François Asselineau avaient commencé à recouvrir les parois du trou noir avec de larges affiches FREXIT ainsi que par des colleurs d’affiches de Nicolas Miguet.</p>','',0,1,'assets/images/image0382352001556542548.jpeg'
	           );





CREATE TABLE category
(
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
name VARCHAR(50) NOT NULL
);
insert into category (name) values ('Sport');
insert into category (name) values ('Meteo');
insert into category (name) values ('Politique');


CREATE TABLE live
(
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
articleDate DATE NOT NULL, 
content text NOT NULL,
tag VARCHAR(30)
);



DROP TABLE IF EXISTS authors;
CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `valid` boolean DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

