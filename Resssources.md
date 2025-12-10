## Packet Tracer
https://www.netacad.com/resources/lab-downloads?courseLang=fr-FR
## Cypress
https://www.cypress.io/#create
## Selenium
https://www.selenium.dev/
## VDI
https://www.osboxes.org/centos/
## Virtual Box
https://www.virtualbox.org/

## lazydocker
https://github.com/jesseduffield/lazydocker

## Coffre fort
Site Officiel Keeper Security (Plans Personnels et Famille)	https://www.keepersecurity.com/fr_FR/personal.html

Solutions pour Entreprises (KeeperPAM, etc.)	https://www.keepersecurity.com/fr_FR/team-password-manager/

Extension Navigateur Chrome (pour le gestionnaire Keeper)	https://chromewebstore.google.com/detail/keeper%C2%AE-password-manager/bfogiafebfohielmmehodmfbbebbbpei?hl=fr

## Exemple api pour render
https://github.com/FrancisThierry/APIDeauville

## Installer Ansible
sudo apt install ansible
 ou avec
pip pip3 install ansible

## Commande Ansible
ansible-playbook -i inventory.ini nodeInstalled.yml

## Supression Warning sur alpine1
ajouter à l'inventaire :
```bash
[all]
alpine1 ansible_python_interpreter=/usr/bin/python3
```

## Signification Code Couleur Ansible 

C'est une excellente question qui touche au cœur de la lisibilité des sorties d'Ansible ! 💡

Lorsque vous exécutez un *playbook* Ansible, les couleurs dans le terminal ne sont pas là pour faire joli ; elles fournissent des informations cruciales sur le résultat de l'exécution de chaque tâche sur les hôtes cibles.

Voici ce que signifient principalement les changements de couleur pour les résultats `CHANGED` et `OK` :

### 🎨 Le code couleur général

| Résultat | Couleur (Typique) | Signification |
| :--- | :--- | :--- |
| **`OK`** | Vert (Green) | La tâche a été exécutée avec succès, mais **aucun changement n'a été effectué** sur le système cible. Le système était déjà dans l'état désiré. |
| **`CHANGED`** | Jaune (Yellow) | La tâche a été exécutée avec succès, et **elle a modifié l'état du système** sur l'hôte cible. |
| **`FAILED`** | Rouge (Red) | La tâche a **échoué**. Le playbook s'arrête généralement (sauf configuration contraire). |
| **`SKIPPED`** | Cyan (Blue) | La tâche a été **sautée** (ex. : condition `when:` non remplie, ou l'hôte n'est pas dans l'inventaire). |
| **`UNREACHABLE`** | Orange/Rouge Foncé | Ansible **n'a pas pu se connecter** à l'hôte (problème de SSH, de réseau, etc.). |

---

### 🟢 `OK` (Vert) : Tout va bien, pas de changement

Un résultat `ok=` en **vert** est le signe que la tâche a été exécutée contre l'hôte spécifié, mais qu'elle était **idempotente** dans ce cas précis.

* **Exemple :** Vous utilisez le module `ansible.builtin.file` pour vous assurer qu'un répertoire existe. S'il existe déjà, Ansible renvoie `ok` et la ligne sera **verte**.
* **Idempotence :** Cela confirme la philosophie d'Ansible : un playbook peut être exécuté plusieurs fois sans provoquer d'effets secondaires non désirés. Le système est déjà dans l'état cible.

---

### 🟡 `CHANGED` (Jaune) : Changement effectué

Un résultat `changed=` en **jaune** signifie qu'Ansible a fait le travail et **a effectivement modifié quelque chose** sur le système cible pour atteindre l'état désiré.

* **Exemple :** Vous utilisez le module `ansible.builtin.apt` pour installer le paquet `nginx`. Si `nginx` n'était pas installé, Ansible l'installe, et le résultat sera `changed` et la ligne sera **jaune**.
* **Indicateur :** C'est un indicateur très important pour savoir si le playbook a eu un impact réel (ex. : un service a été redémarré, un fichier a été modifié, un paquet a été installé).

---

### Résumé Clé

La différence entre les deux est donc l'**impact** de la tâche sur l'état de l'hôte cible :

| Résultat | État final de l'hôte |
| :--- | :--- |
| **`OK` (Vert)** | Le système **n'a pas changé** car il était déjà dans l'état désiré. |
| **`CHANGED` (Jaune)** | Le système **a été modifié** pour atteindre l'état désiré. |


