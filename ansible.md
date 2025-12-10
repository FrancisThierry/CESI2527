
## 💡 Concepts Fondamentaux d'Ansible

Ansible utilise des **fichiers YAML** (Yet Another Markup Language) pour définir les tâches et la configuration.

### 1\. Les Modules (Modules)

Les **modules** sont l'unité de travail d'Ansible. Ce sont de petits programmes que l'on exécute sur les machines cibles (vos serveurs). Chaque module est conçu pour réaliser une tâche spécifique.

  * **Syntaxe :** Ils sont appelés dans une tâche (task) en utilisant leur nom et en spécifiant des arguments (options).
  * **Exemples courants :**
      * `ansible.builtin.package` : Gère l'installation, la mise à jour ou la suppression de paquets (comme `apt` ou `yum`).
      * `ansible.builtin.copy` : Copie des fichiers de la machine de contrôle vers les machines cibles.
      * `ansible.builtin.service` : Démarre, arrête ou redémarre des services.
      * `ansible.builtin.debug` : Affiche des messages (utile pour le débogage).

**Exemple de tâche utilisant le module `ansible.builtin.package` :**

```yaml
- name: Installer le serveur web Nginx
  ansible.builtin.package:
    name: nginx
    state: present
```

-----

### 2\. Les Variables (Variables)

Les **variables** sont utilisées pour stocker des valeurs qui peuvent être réutilisées, ce qui rend vos **playbooks** (les fichiers d'instructions) plus flexibles et réutilisables.

  * **Déclaration :** Elles peuvent être définies à plusieurs endroits (dans des fichiers séparés, dans l'inventaire, ou directement dans le playbook sous la section `vars:`).
  * **Utilisation :** On les référence en utilisant la syntaxe **Jinja2** (voir point 4), c'est-à-dire en les encadrant par des doubles accolades : `${{ variable_name }}`.

**Exemple de déclaration et d'utilisation de variable :**

```yaml
- name: Installer un paquet via une variable
  hosts: webservers
  vars:
    web_package: apache2
  tasks:
    - name: Installation du paquet
      ansible.builtin.package:
        name: "{{ web_package }}" # La variable est appelée ici
        state: present
```

-----

### 3\. Les Boucles (Loops)

Les **boucles** vous permettent d'exécuter une tâche **plusieurs fois** avec différentes valeurs sans avoir à réécrire la tâche. C'est essentiel pour la gestion de listes.

  * **Mot-clé principal :** `loop`
  * **Utilisation :** On place le mot-clé `loop:` sous la tâche, suivi de la liste des éléments à parcourir. À l'intérieur de la tâche, la valeur actuelle de l'itération est accessible via la variable magique `item`.

**Exemple de boucle pour créer plusieurs utilisateurs :**

```yaml
- name: Créer plusieurs utilisateurs
  hosts: database_servers
  tasks:
    - name: Ajout des utilisateurs
      ansible.builtin.user:
        name: "{{ item }}" # item contient user1, puis user2, etc.
        state: present
      loop:
        - user1
        - user2
        - admin_db
```

-----

### 4\. Jinja2

**Jinja2** est le moteur de **templating** (modélisation) utilisé par Ansible. Il permet d'insérer des valeurs dynamiques, des variables, et d'appliquer de la logique (comme des conditions ou des filtres) dans vos fichiers de configuration et vos playbooks.

  * **Syntaxe pour afficher une variable :** `${{ variable_name }}`
  * **Syntaxe pour la logique (conditions, boucles, filtres) :** `{% expression %}`

Le cas d'usage le plus fréquent est la création de **templates** (souvent avec l'extension `.j2`) en utilisant le module `ansible.builtin.template`.

**Exemple de template Jinja2 (`config.conf.j2`) :**

```jinja
ServerName: ${{ server_hostname }}
ListenPort: ${{ http_port | default(80) }} # Utilise 80 si http_port n'est pas défini

{% if environment == 'production' %}
LogFile: /var/log/app/prod.log
{% else %}
LogFile: /var/log/app/dev.log
{% endif %}
```

-----

## 📚 Tableau de Vocabulaire Ansible 

Voici les termes essentiels à connaître pour bien démarrer avec Ansible.

| Terme | Description | Analogie  |
| :--- | :--- | :--- |
| **Playbook** | Fichier YAML principal qui contient l'ensemble des instructions, des tâches et la logique à exécuter. | La **recette** de cuisine complète pour configurer le serveur. |
| **Inventaire (Inventory)** | Fichier (souvent `hosts`) qui liste les serveurs (nœuds gérés) à configurer, organisés en groupes. | Le **carnet d'adresses** où sont listés les serveurs. |
| **Hôte (Host)** | Une seule machine cible (serveur, VM, conteneur) que vous configurez. | L'**individu** qui va appliquer la recette. |
| **Tâche (Task)** | Une action unique exécutée par un module sur les hôtes. | Une **étape** spécifique dans la recette (ex: "éplucher les légumes"). |
| **Module** | L'unité de code qui fait le travail réel (installer un paquet, copier un fichier, etc.). | L'**ustensile** de cuisine (ex: `ansible.builtin.copy` est une spatule). |
| **Rôle (Role)** | Un moyen d'organiser et de réutiliser des playbooks, variables, tâches et templates selon une structure de dossiers standardisée. | Un **kit pré-assemblé** (ex: le rôle "Webserver" contient tout pour un serveur web). |
| **Idempotence** | Le principe qu'exécuter une tâche plusieurs fois aura le même résultat que de l'exécuter une seule fois (Ansible ne fait rien si l'état désiré est déjà atteint). | **Ne pas resaler** un plat déjà bien salé. |
| **Handlers** | Tâches spéciales qui ne s'exécutent que si une tâche précédente les "notifie" d'un changement. | La **règle** "si on modifie le fichier de conf, il faut redémarrer le service". |

-----
C'est une excellente question de niveau intermédiaire \! Les **Rôles (Roles)** sont la façon la plus efficace et recommandée de structurer des projets Ansible complexes et réutilisables. Ils apportent clarté, organisation et portabilité.

Voici comment bien structurer les rôles et pourquoi cette structure standard est utilisée.

-----

## 🏗️ Structure Standard d'un Rôle Ansible

Un rôle Ansible suit une structure de répertoire très précise. Si vous utilisez l'outil `ansible-galaxy init mon_role`, il va créer automatiquement la structure suivante :

```
mon_role/
├── defaults/
│   └── main.yml      # Variables par défaut (faible priorité)
├── vars/
│   └── main.yml      # Variables spécifiques au rôle (haute priorité)
├── tasks/
│   └── main.yml      # Liste des tâches principales à exécuter (le cœur du rôle)
├── handlers/
│   └── main.yml      # Liste des "handlers" (actions notifiées, comme redémarrer un service)
├── templates/
│   └── ...           # Fichiers Jinja2 (.j2) utilisés pour générer des fichiers de configuration
├── files/
│   └── ...           # Fichiers statiques qui sont copiés tels quels (scripts, clés...)
├── meta/
│   └── main.yml      # Métadonnées (dépendances du rôle, compatibilité)
└── README.md         # Documentation du rôle (indispensable !)
```

### 1\. ⚙️ `tasks/` (Le Cœur du Rôle)

C'est là que réside la logique.

  * **`tasks/main.yml`**: Le point d'entrée principal du rôle. Il doit être **court** et servir de "table des matières" pour le rôle.
  * **Organisation**: Utilisez le mot-clé `include_tasks` pour diviser les tâches en plusieurs fichiers pour une meilleure lisibilité :
    ```yaml
    # tasks/main.yml
    - name: Configuration de base
      ansible.builtin.include_tasks: setup.yml

    - name: Installation de l'application
      ansible.builtin.include_tasks: install.yml

    - name: Démarrage et vérification du service
      ansible.builtin.include_tasks: start.yml
    ```
    *Chaque fichier (ex: `tasks/setup.yml`) contient les tâches spécifiques à cette étape.*

### 2\. 🛡️ `defaults/` vs. `vars/` (Priorité des Variables)

La gestion des variables est cruciale.

  * **`defaults/main.yml`**: Contient les **valeurs par défaut** du rôle. Ce sont les variables avec la **priorité la plus faible**.

      * **Utilisation**: Elles servent de valeurs de repli. Si un utilisateur utilise votre rôle sans définir une variable, celle-ci sera utilisée. Cela permet à l'utilisateur de les **écraser facilement** (override) dans son playbook ou son inventaire.

  * **`vars/main.yml`**: Contient des variables **spécifiques** au rôle qui ne sont généralement **pas** destinées à être modifiées par l'utilisateur du rôle (ex: chemins d'accès internes, numéros de port par défaut que l'utilisateur *devrait* modifier, etc.). Ce sont des variables de **priorité plus élevée** que `defaults`.

### 3\. 🔄 `handlers/` (Gestion des Changements)

  * **`handlers/main.yml`**: Contient des tâches qui s'exécutent **uniquement** si une tâche dans `tasks/` les a notifiées (`notify`).
  * **Idempotence**: Les handlers garantissent l'idempotence. Par exemple, vous ne redémarrez le service Nginx que si son fichier de configuration a réellement été modifié.

### 4\. 📄 `templates/` vs. `files/` (Données Statiques vs. Dynamiques)

  * **`templates/`**: Placez ici tous les fichiers qui doivent être générés dynamiquement et qui contiennent des variables Jinja2 (`.j2`). Utilisez le module `ansible.builtin.template` pour les déployer.

      * *Exemple :* `nginx.conf.j2` (le fichier de configuration principal du serveur web).

  * **`files/`**: Placez ici tous les fichiers binaires ou statiques qui sont copiés **tels quels** (sans traitement Jinja2). Utilisez le module `ansible.builtin.copy` pour les déployer.

      * *Exemple :* Des scripts bash, des clés SSH, des certificats, etc.

### 5\. 🖇️ `meta/` (Dépendances)

  * **`meta/main.yml`**: C'est là que vous définissez les **dépendances** du rôle. Si votre rôle "webserver" dépend du rôle "common-setup" pour l'installation de certains paquets de base, vous le spécifiez ici :
    ```yaml
    # meta/main.yml
    dependencies:
      - role: common-setup
    ```
    Lors de l'exécution, Ansible s'assurera que le rôle dépendant est exécuté avant le rôle actuel.

-----

## ✅ Bonnes Pratiques pour la Structure

1.  **Modularité avant tout (Tasks)** : Évitez d'avoir un `tasks/main.yml` de 500 lignes. Divisez-le en fichiers logiques (ex: `install.yml`, `config.yml`, `firewall.yml`).

2.  **Rôles Atomiques** : Un rôle doit faire **une seule chose bien**. Évitez un rôle monolithique "serveur-complet". Préférez un rôle "nginx", un rôle "postgresql" et un rôle "monitoring".

3.  **Documentation (README)** : Incluez toujours un `README.md` expliquant :

      * Le but du rôle.
      * Les variables obligatoires ou les plus importantes que l'utilisateur peut (et doit) écraser.
      * Les dépendances.

4.  **Nommage Explicite** : Nommez vos tâches de manière claire.

      * *Mauvais :* `- name: install pkg`
      * *Bon :* `- name: S'assurer que le paquet python-pip est installé`
