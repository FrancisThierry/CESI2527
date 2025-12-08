
# 🚀 WeWeb : Le Commencement d'une Aventure Numérique

![alt text](image.png)

| **Aspect** | **Détail** |
|---|---|
| **Date de création** | 2024 |
| **Fondateurs** | Alice Dupont et Ben Lemaire |
| **Activité principale** | Conception et réalisation de sites web élégants et performants pour PME locales |

## I. L'Idée Fondatrice

Tout commence dans un petit garage transformé en bureau, où **Alice** (designer web talentueuse) et **Ben** (développeur passionné) décident de s'associer. 

**Constat** : Beaucoup de PME ont des sites datés, lents et mal optimisés.

**Objectif WeWeb** : Proposer des solutions numériques sur mesure axées sur :
- ⚡ **Vitesse de chargement**
- 🎯 **Expérience utilisateur (UX)**

## II. L'Infrastructure Initiale : Le "Starter Pack" du LAN

### 🔌 1. Connectivité et Cœur du Réseau

| Équipement | Rôle |
|---|---|
| **Routeur Wi-Fi** | Passerelle Internet & Distributeur DHCP |
| **Switch 8 Ports** | Câblage Ethernet pour connexion stable |

### 💼 2. Postes de Travail et Ressources

- **2 PC Windows** : Alice (Design) & Ben (Développement)
- **Imprimante Réseau** : Partage des contrats et maquettes
- **Serveur NAS** : Centralisation des fichiers clients, projets, sauvegarde

## III. Le Défi pour les TD

WeWeb fait face à ses premières limites :
- ⚠️ Performance web insuffisante
- 📦 Besoin d'une solution **CDN (Content Delivery Network)**

**Votre mission** : Accompagner WeWeb dans sa croissance en analysant et évoluant son infrastructure.

---

# 🛠️ Cahier de Travaux Dirigés - Infrastructure & Réseau WeWeb

Ce cahier couvre l'**évolution de l'infrastructure WeWeb** à travers des ateliers pratiques.

---

## 💻 Atelier 1 : Modélisation du Réseau Local (LAN) & Fondamentaux OSI

**Objectif** : Visualiser l'architecture de base et réviser les couches OSI.

### 1.1 Représentation Physique

**Tâche** : Dessiner ou modéliser le réseau initial avec **Cisco Packet Tracer**.

![Diagramme réseau petit bureau : 2 PC, serveur, imprimante → switch → routeur Wi-Fi]

**Composants** : 2 PC, NAS, imprimante, switch, routeur Wi-Fi

**Livrable** : Schéma montrant connexions filaires vs. Wi-Fi


## Diagramme

```mermaid
graph TB
    Internet[Internet]
    Router[Routeur Wi-Fi]
    Switch[Switch 8 Ports]
    PC1[PC Windows - Alice]
    PC2[PC Windows - Ben]
    NAS[Serveur NAS]
    Printer[Imprimante Réseau]
    
    Internet -->|Ethernet| Router
    Router -->|Ethernet| Switch
    Router -->|Wi-Fi| PC1
    Router -->|Wi-Fi| PC2
    Switch -->|Ethernet| PC1
    Switch -->|Ethernet| PC2
    Switch -->|Ethernet| NAS
    Switch -->|Ethernet| Printer
```

### 1.2 Identification des Rôles

| Question | Réponse |
|---|---|
| **Passerelle** ? | |
| **Point de concentration filaire** ? | |
| **Rôle du NAS** ? | |

**Livrable** : Tableau synthétique des rôles et protocoles (DHCP, NAT)

### 1.3 Exercice : Devinez la Couche OSI 🧐

Associez chaque description au **numéro de couche OSI** (1-7) :

| Description | Couche |
|:---|:---:|
| Transmission brute des bits (câbles, ondes radio) | |
| Accès au support (MAC) - Exemple : Ethernet | |
| Adressage logique (IP) et routage | |
| Communication bout à bout (TCP/UDP) | |
| Gestion des sessions | |
| Traduction, chiffrement, compression | |
| Services applicatifs - Exemple : HTTP, DNS | |

---

## 📱 Atelier 2 : Réseau PAM et Intégration WSL

**Objectif** : Maîtriser le **PAM (Point d'Accès Mobile)** et la mise en réseau **WSL**.

### 📌 Qu'est-ce qu'un PAM ?

**PAM = Hotspot mobile** transformant votre smartphone en routeur Wi-Fi (NAT/DHCP) utilisant la 4G/5G.

### 2.1 Mise en Place du PAM

✅ Activer le **Point d'Accès Mobile** sur votre smartphone  
✅ Connecter votre **PC Windows** en Wi-Fi

### 2.2 Analyse du Réseau Hôte

**Commandes** :
```bash
ipconfig          # Identifier IP PC et passerelle
ping [smartphone] # Tester la connectivité
```

**Livrable** : Adresses IP + résultat `ping`

Je créé un page web minimale avec node comme

app.js + index.html

Mon adresse :
172.25.159.246

Sur mon smartphone :
172.25.159.246:3000



### 2.3 Intégration WSL 2

## Vérifier configuration Windows

![alt text](image-1.png)

**Commandes WSL** :
```bash
ip a              # Trouver l'IP du WSL
ping [PC_IP]      # Ping vers Windows
ping [Passerelle] # Ping vers smartphone
```

![alt text](image-2.png)

```bash
ping 172.25.159.246 
```
![alt text](image-3.png)

**Tests de connectivité à valider** :
1. ✓ PC Windows → WSL
2. ✓ WSL → PC Windows
3. ✓ WSL → Passerelle PAM

**Livrable** : IP du WSL + résultats des 3 tests


## Configurer ngnix pour les ressources cdn

![alt text](image-6.png)
---

## 🌐 Atelier 3 : CDN Statique Local

**Objectif** : Déployer un **CDN local** pour améliorer la performance des ressources statiques.

## Exemple sur Smartphone

![alt text](image-4.png)

### 3.1 Conception et Sécurité du CDN

**Tâche** : Dessiner l'architecture CDN (serveur source → caches → utilisateurs)


```mermaid
graph LR
    Users["👥 Utilisateurs<br/>(Smartphones/PC)"]
    Cache1["⚡ Cache 1<br/>(Région 1)"]
    Cache2["⚡ Cache 2<br/>(Région 2)"]
    Cache3["⚡ Cache 3<br/>(Région 3)"]
    Origin["🖥️ Serveur Origine<br/>(Source)"]
    
    Users -->|Requête| Cache1
    Users -->|Requête| Cache2
    Users -->|Requête| Cache3
    
    Cache1 -->|Miss: Récupère| Origin
    Cache2 -->|Miss: Récupère| Origin
    Cache3 -->|Miss: Récupère| Origin
    
    Origin -->|Réplique contenu| Cache1
    Origin -->|Réplique contenu| Cache2
    Origin -->|Réplique contenu| Cache3
    
    Cache1 -->|Contenu en cache| Users
    Cache2 -->|Contenu en cache| Users
    Cache3 -->|Contenu en cache| Users
    
    style Origin fill:#ff6b6b
    style Cache1 fill:#51cf66
    style Cache2 fill:#51cf66
    style Cache3 fill:#51cf66
    style Users fill:#4dabf7
```



#### ❓ Question 1 : DMZ
Faut-il placer les serveurs CDN (contenu public) en **DMZ** ?  
**Argumenter votre réponse.**

#### ❓ Question 2 : Opérations Infrastructure
Citer et décrire **3 opérations essentielles** pour gérer le CDN :
- (ex: mise en cache, purge, journalisation)

**Livrable** : Schéma + analyses DMZ & opérations

### 3.2 Implémentation avec WSL et PAM

**Étape 1** : Installer un serveur web dans WSL
```bash
# Ubuntu/Debian
sudo apt update && sudo apt install nginx
sudo systemctl start nginx
```
### Test de la page par défaut ngnix

![alt text](image-5.png)


**Étape 2** : Créer contenu statique
```bash
mkdir -p /var/www/cdn
echo "/* CSS */" > /var/www/cdn/style.css
echo "// JS" > /var/www/cdn/script.js
```

**Étape 3** : Tester depuis le smartphone
```
http://[IP_WSL]/style.css
http://[IP_WSL]/script.js
```

**Livrable** : Commandes + Preuve d'accès réussi


