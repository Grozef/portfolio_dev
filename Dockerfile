# Utiliser l'image PHP avec Apache
FROM php:8.2-apache

# Installer uniquement unzip et zip
RUN apt-get update && \
    apt-get install -y --no-install-recommends unzip zip && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer les extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Installer Node.js et npm
RUN apt-get update && apt-get install -y \
    curl && \
    curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Activer le module Apache Rewrite
RUN a2enmod rewrite

# Ajouter une directive ServerName pour éviter un avertissement
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configurer le DocumentRoot pour Symfony
RUN sed -i "s|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g" /etc/apache2/sites-available/000-default.conf

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet dans le conteneur
COPY . .

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer les dépendances de Composer
RUN composer install --no-interaction --optimize-autoloader --prefer-dist

# Exposer le port 80
EXPOSE 80
