# Banektek — Application bancaire web (Symfony)

Banektek est une application bancaire web **mobile‑friendly** développée avec **Symfony**.  
Elle permet la gestion complète des clients, agences et comptes, avec virements sécurisés, crédits, réclamations, et un système de contenu (articles/commentaires).  
L’app intègre aussi des services avancés : **FaceID login**, **OTP via Twilio**, **mailing automatique**, **prédiction de credit score**, et **génération PDF** (virements / crédits / transactions).  

---

## ✨ Fonctionnalités principales

### 🏦 Gestion bancaire
- Gestion des **Agences** et **Agents**
- Gestion des **Clients**
- Gestion des **Comptes bancaires**
- Gestion des **Cartes bancaires**
- **Transactions** (Retrait / Versement)
- **Virements** inter‑comptes + frais par type de virement
- Gestion des **Crédits** + échéances
- Historique et statistiques (soldes, flux, etc.)

### 🔐 Sécurité & Authentification
- Auth **JWT** (LexikJWTAuthenticationBundle)
- Login sécurisé **QR Code**
- **FaceID login** (reconnaissance faciale)
- OTP / SMS via **Twilio**
- **Google reCAPTCHA v3** anti‑bots
- Protections anti‑triche côté front (détection de modifications JS / F12‑inspect, limitation de changements de valeurs)

### 📩 Communication
- **Mailing automatique** (bienvenue, relevés, notifications)
- SMS transactionnels via Twilio

### 🤖 IA / Scoring
- Algorithme de **prédiction de credit score** pour aider à la décision d’octroi de crédit  

### 🧾 Documents & Exports
- Génération et impression **PDF** :
  - reçus de virements
  - contrats / détails crédits
  - rapports transactions
- Export possible depuis l’espace client/agent

### 📰 Contenu & interaction
- Blog interne : **Articles** créés par agents
- **Commentaires & notes** par clients

---

## 🧱 Entités (Doctrine)

- **Agence**
  - adresse, nom, num_tel, état, chef (Agent), géoloc (lat/long), date_ajout
  - relations : OneToMany Agents, Comptes

- **Agent** *(UserInterface)*
  - nom, prénom, poste, matricule, password, email, num_tel, photo, faceid
  - relations : ManyToOne Agence, OneToMany Articles & Réponses

- **Client**
  - informations perso, username/password auto‑généré, état, photo, last_login…
  - relations : OneToMany Comptes, Réclamations, Demandes…

- **Compte**
  - type, solde, rib, état, dates création/fermeture
  - relations : ManyToOne Client & Agence, OneToMany Transactions, Virements, Crédits

- **Carte**
  - compte, dates émission/expiration, cvv, plafond, type, état

- **Transaction**
  - type, date_transaction, montant, compte

- **Virement**
  - émetteur / bénéficiaire, montant, dates émission/approbation, état, typeVirement, cin/photo CIN

- **TypeVirement**
  - nom, frais

- **Credit**
  - montant, taux, durée, type, état, apport/revenu, échéances restantes…
  - relations : ManyToOne Compte, OneToMany Échéances

- **Echeance**
  - mode_paiement, état, date, credit

- **Reclamation**
  - date_reclamation, type, description, état, document, email
  - relations : ManyToOne Client, OneToMany Réponses

- **Reponse**
  - reclamation, agent, date_reponse, message

- **Article**
  - agent, date_pub, titre, contenu, image
  - relations : OneToMany Commentaires

- **Commentaire**
  - user (Client), article, contenu, note, date

---

## 🛠️ Stack technique

- **Backend** : Symfony 6/7, PHP 8.1+
- **ORM / DB** : Doctrine, MySQL / MariaDB
- **Auth** : LexikJWTAuthenticationBundle
- **Mailing** : Symfony Mailer / PHPMailer
- **SMS/OTP** : Twilio SDK
- **Captcha** : karser/karser‑recaptcha3‑bundle
- **PDF** : Dompdf / KnpSnappy (wkhtmltopdf)
- **Front** : Twig + Bootstrap/Tailwind + JS
- **Mobile friendly** : Responsive design + QR login

---

## 🚀 Installation & Lancement

### 1) Prérequis
- PHP 8.1+
- Composer
- MySQL/MariaDB
- Symfony CLI *(optionnel mais recommandé)*
- Node.js *(si assets front buildés)*

### 2) Cloner le projet
```bash
git clone https://github.com/<your-username>/banektek.git
cd banektek
```

### 3) Installer les dépendances
```bash
composer install
```

### 4) Configurer l’environnement
Copie `.env` → `.env.local` et **remplace les secrets par tes valeurs locales** :

```env
APP_ENV=dev
APP_SECRET=your_app_secret

DATABASE_URL="mysql://root:@127.0.0.1:3306/banektek?serverVersion=mariadb-10.4.11"

# JWT
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=your_passphrase

# Twilio
TWILIO_ACCOUNT_SID=your_sid
TWILIO_AUTH_TOKEN=your_token
TWILIO_PHONE_NUMBER=your_phone

# reCAPTCHA v3
RECAPTCHA3_KEY=your_site_key
RECAPTCHA3_SECRET=your_secret

# Mailer
MAILER_DSN=smtp://your_email:your_password@smtp.gmail.com:587?encryption=tls&auth_mode=login
```

> ⚠️ **Ne commit jamais tes vraies clés (Twilio, Gmail, JWT, reCAPTCHA) sur GitHub.**  
> Utilise `.env.local` (ignoré par Git) ou les secrets Symfony.

### 5) Générer les clés JWT
```bash
php bin/console lexik:jwt:generate-keypair
```

### 6) Créer la base + migrations
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 7) (Optionnel) Charger des fixtures
```bash
php bin/console doctrine:fixtures:load
```

### 8) Lancer le serveur
```bash
symfony serve -d
# ou
php -S localhost:8000 -t public
```

➡️ App disponible sur `http://localhost:8000`

---

## 🧪 Tests
```bash
php bin/phpunit
```

---

## 📌 Notes d’usage

- **FaceID login** : utilise l’API Facio pour la reconnaissance faciale (le modèle compare en temps réel le visage avec celui enregistré en base)
- **QR secure login** : QR généré côté back pour éviter le spoofing.
- **Credit score** : basé sur un algorithme avancé if/else (règles métier pondérées) pour calculer un score et donner une recommandation lors de la création d’un crédit — ce n’est pas un modèle Machine Learning.
- **PDF** : accessibles depuis les pages Virement / Crédit / Transaction.

---

## 👥 Auteurs
Projet **Banektek** — application académique / démonstration.  
Développé par l’équipe Banektek.

---

## 📄 Licence
Ce projet est sous licence MIT — libre d’utilisation pour un usage éducatif ou de démonstration.
## 📸 Aperçu général de l'application web Banektek

---

# 🖥️ FRONT – Interface Client

### 1️⃣ Formulaire de création de compte
![Formulaire de création de compte](image.png)

### 2️⃣ Page d’accueil (Home Page)
![Home Page](image-2.png)

### 3️⃣ Convertisseur de devises
![Convertisseur de devises](image-3.png)

### 4️⃣ Simulateur de crédit – Côté client (Front)
![Simulateur de crédit client](image-4.png)

### 5️⃣ Profil du client – Interface Front
![Profil du client](image-6.png)

### 6️⃣ Tableau de bord avec KPIs  
*(Mes activités, mes dépenses, statistiques Retrait vs Versement)*
![Tableau de bord KPIs](image-7.png)

---

# 🛠️ BACK – Interface Agent / Admin

### 7️⃣ Formulaire FaceID – Authentication Agent
![Test FaceID agent](image-1.png)

### 8️⃣ Gestion des comptes – Back-office (Admin / Agent)
![Gestion des comptes back](image-5.png)

### 9️⃣ Formulaire d’ajout de crédit avec barre verte de Credit Scoring
![Formulaire crédit scoring](image-9.png)
