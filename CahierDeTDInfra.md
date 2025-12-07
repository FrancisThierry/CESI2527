
# 🚀 WeWeb : Le Commencement d'une Aventure Numérique

**Date de création :** 2024
**Fondateurs :** Alice Dupont et Ben Lemaire
**Activité principale :** Conception et réalisation de sites web élégants et performants pour les petites et moyennes entreprises locales.

## I. L'Idée Fondatrice

Tout commence dans un petit garage transformé en bureau, où Alice, une designer web talentueuse, et Ben, un développeur passionné par la performance, décident de s'associer. Leur constat est simple : beaucoup de PME ont des sites datés, lents et mal optimisés.

L'objectif d'**WeWeb** est de proposer des solutions numériques sur mesure, en mettant l'accent sur la **vitesse de chargement** et l'**expérience utilisateur (UX)**.

## II. L'Infrastructure Initiale : Le "Starter Pack" du LAN

Pour démarrer, les fondateurs se concentrent sur une infrastructure locale, simple, mais fonctionnelle, pensée pour l'efficacité et le partage des ressources. C'est l'épine dorsale de l'entreprise à ses débuts :

### 1. La Connectivité et le Cœur du Réseau

* **Le Routeur Wi-Fi (La Passerelle) :** C'est le point d'accès à Internet et le distributeur d'adresses IP pour tous les appareils. Il permet la connexion sans fil pour les smartphones et tablettes des fondateurs.
* **Le Switch 8 Ports (Le Câblage) :** Un petit boîtier essentiel pour connecter les appareils critiques par câble Ethernet, assurant une connexion stable et rapide pour le transfert de gros fichiers de design et de code.

### 2. Les Postes de Travail et les Ressources

* **Deux PC Windows :** Les postes de travail d'Alice (Design, graphisme) et de Ben (Développement, tests).
* **Une Imprimante Réseau :** Partagée pour l'impression des contrats et des maquettes préliminaires.
* **Un Serveur de Stockage (NAS) :** Le cœur du travail collaboratif. Il centralise tous les fichiers clients, les projets en cours, les bibliothèques de CSS/JS, et les sauvegardes. Il assure que les deux fondateurs travaillent sur la même version des données.

## III. Le Défi pour les TD

Alors que WeWeb prend de l'ampleur, les fondateurs se heurtent aux premières limites de leur installation :

* **La Performance Web :** Ils cherchent à améliorer la vitesse de livraison des assets (CSS, JS) de leurs sites clients, en envisageant une solution de type **CDN (Content Delivery Network)** pour l'avenir.

**Votre mission** est d'accompagner WeWeb dans cette phase de croissance, en analysant, modélisant et faisant évoluer leur infrastructure de base pour répondre à ces nouveaux enjeux.

---

# 🛠️ Cahier de Travaux Dirigés - Infrastructure & Réseau WeWeb

Ce cahier est structuré autour de l'évolution de l'infrastructure de la société WeWeb. Chaque atelier représente une étape clé dans la compréhension et l'optimisation des réseaux.

---

## 💻 Atelier 1 : Modélisation du Réseau Local (LAN) & Fondamentaux OSI

**Objectif :** Visualiser l'architecture de base de WeWeb et réviser les couches fondamentales de communication réseau.

### 1.1 Représentation Physique
* **Tâche :** Dessiner le schéma du réseau initial de WeWeb ou le modéliser à l'aide de **Cisco Packet Tracer**. 

[Image of a basic small office network diagram showing two PCs, a server, a printer connected to a switch, which is connected to a WiFi router]

* **Composants à inclure :** Deux PC Windows, un Serveur de Stockage (NAS), une Imprimante Réseau, un Switch, et un Routeur Wi-Fi.
* **Livrable :** Un schéma clair montrant les connexions (Ethernet filaire vs. Wi-Fi) entre les équipements.

### 1.2 Identification des Rôles
* **Tâche :** Décrire le rôle de chaque équipement dans le LAN de WeWeb.
    * Quel équipement est la **Passerelle** ?
    * Quel équipement est le point de concentration des connexions filaires ?
    * Quel rôle joue le Serveur de Stockage par rapport aux postes clients ?
* **Livrable :** Un tableau de synthèse des rôles et des protocoles utilisés (ex: DHCP, NAT).

### 1.3 Exercice : Devinez la Couche OSI 🧐

**Objectif :** Associer chaque description à la couche correspondante du modèle **OSI** (Open Systems Interconnection). Remplissez la colonne de droite avec le **numéro de la couche** (de 1 à 7).

| Description/Rôle Clé | Couche OSI Correspondante (Numéro 1 à 7) |
| :--- | :---: |
| Responsable de la transmission brute des bits sur le support physique (câbles, ondes radio). Détermine les spécifications électriques et mécaniques. | |
| Gère l'accès au support (MAC) et le contrôle d'erreurs au niveau local. Protocole d'exemple : Ethernet. | |
| Gère l'adressage logique (IP) et le routage des paquets à travers des réseaux multiples. | |
| Assure la communication de bout en bout et gère la fiabilité (TCP) ou la rapidité (UDP) de la livraison des données. | |
| Établit, gère et termine les sessions de communication entre deux applications. | |
| S'occupe de la traduction, du chiffrement et de la compression des données pour s'assurer que les applications peuvent les lire. | |
| Couche la plus proche de l'utilisateur final. Fournit des services réseau aux applications. Protocole d'exemple : HTTP, FTP, DNS. | |

---

## 📱 Atelier 2 : Création d'un Réseau PAM (Point d'Accès Mobile) et Intégration WSL

**Objectif :** Comprendre le fonctionnement d'un mini-réseau mobile (PAM) et maîtriser la mise en réseau de sous-systèmes logiciels (WSL) sur la machine hôte.

### Qu'est-ce qu'un Réseau PAM ?
Le **PAM (Point d'Accès Mobile)**, ou Hotspot, transforme un appareil mobile (smartphone, tablette) en **routeur Wi-Fi**. Il crée un petit **LAN** temporaire et utilise la connexion de données de l'opérateur (4G/5G) comme connexion Internet externe. Il agit comme un **routeur NAT/DHCP** pour les appareils connectés (PC, autres smartphones).

### 2.1 Mise en Place du Réseau PAM
* **Tâche :** Activer la fonction **Point d'Accès Mobile** sur votre smartphone.
* **Tâche :** Connecter votre **PC Windows** au réseau Wi-Fi émis par le smartphone.

### 2.2 Analyse du Réseau Hôte
* **Tâche :** Depuis le PC, utiliser la commande `ipconfig` (Windows) pour identifier :
    * L'**adresse IP** de votre PC (client).
    * L'**adresse IP de la passerelle** (votre smartphone).
* **Tâche :** Tester la connectivité (`ping`) entre le PC et le smartphone.
* **Livrable :** Les adresses IP obtenues et le résultat du test de `ping`.

### 2.3 Intégration du Sous-Système Linux (WSL)
* **Contexte :** WSL est une machine virtuelle légère intégrée à Windows. Dans la version **WSL 2**, le sous-système Linux a sa propre adresse IP.
* **Tâche :** Ouvrir votre distribution Linux sous WSL 2 (ex: Ubuntu).
* **Tâche :** Utiliser la commande `ip a` ou `ifconfig` dans WSL pour trouver l'**adresse IP** de votre machine Linux.
* **Tâche :** Effectuer les tests de connectivité suivants :
    1.  `ping` du **PC Windows** vers l'adresse IP du **WSL**.
    2.  `ping` du **WSL** vers l'adresse IP du **PC Windows**.
    3.  `ping` du **WSL** vers l'adresse IP de la **Passerelle PAM** (votre smartphone).
* **Livrable :** L'adresse IP du WSL et les résultats des trois tests de `ping`.

---

## 🌐 Atelier 3 : Conception et Implémentation d'un CDN Statique Local

**Objectif :** Simuler l'amélioration de la performance des sites web de WeWeb en concevant et déployant un serveur de distribution de contenu (CDN) local pour les ressources statiques (CSS, JS).

### 3.1 Conception et Sécurité du CDN

* **Tâche :** Dessiner l'architecture d'un CDN simplifié (comprenant le serveur source, les serveurs de cache périphériques et les utilisateurs). 
* **Question 1 : DMZ (Zone Démilitarisée)**
    * **Analyse :** Faut-il placer les serveurs CDN (qui servent du contenu public) dans une **DMZ** si l'on considère la sécurité de l'infrastructure de WeWeb ? Argumenter votre réponse.
* **Question 2 : Opérations d'Infrastructure sur un CDN**
    * **Analyse :** Citer et décrire trois opérations d'infrastructure essentielles que WeWeb devrait mettre en place pour gérer efficacement son CDN (ex: la mise en cache, la purge, la journalisation).
* **Livrable :** Le schéma de l'architecture CDN, l'analyse sur la DMZ, et la description des trois opérations d'infrastructure.

### 3.2 Implémentation du CDN Statique avec WSL et PAM

* **Tâche :** Installer un serveur Web léger (ex: **Nginx** ou **Apache**) dans votre sous-système **WSL** (machine Linux).
    * *Rappel : L'adresse IP du WSL agit comme l'adresse du serveur CDN local.*
* **Tâche :** Créer un répertoire de contenu statique dans WSL et y placer :
    * Un fichier CSS simple : `style.css`
    * Un fichier JavaScript simple : `script.js`
* **Tâche :** S'assurer que le service web est démarré dans WSL et écoute sur le port 80 ou 8080.
* **Test d'Accès au CDN (Client) :**
    * Depuis votre **smartphone** (client connecté au réseau PAM), ouvrir un navigateur.
    * Accéder aux fichiers statiques en utilisant l'adresse IP du WSL :
        * `http://[Adresse_IP_WSL]/style.css`
        * `http://[Adresse_IP_WSL]/script.js`
* **Livrable :** La commande utilisée pour démarrer le serveur Web dans WSL et la confirmation de l'accès réussi depuis le smartphone.

