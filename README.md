# End-to-End CI/CD Pipeline for 3-Tier PHP Application

## Project Overview

This project implements an end-to-end CI/CD pipeline for a 3-tier PHP application using AWS, GitHub, Jenkins, Docker, Amazon ECR, Kubernetes, Helm, MySQL, Prometheus, and Grafana.

The pipeline automatically builds a Docker image, tags it using the Jenkins build number, pushes it to Amazon ECR, validates the Helm chart, and deploys the application to Kubernetes.

## Architecture

```text
Developer
    |
    v
GitHub
    |
    v
Jenkins
    |
    +--> Docker Build
    |
    +--> Amazon ECR
    |
    +--> Helm
             |
             v
        Kubernetes
        /        \
       /          \
   PHP App       MySQL
     Pod           Pod
                    |
                    v
                   PVC

Prometheus --> Grafana
                   |
                   +--> Node CPU/Memory
                   +--> Pod CPU/Memory
Technology Stack
Component	Technology
Source Control	GitHub
CI/CD	Jenkins
Containerization	Docker
Container Registry	Amazon ECR
Orchestration	Kubernetes
Deployment	Helm
Application	PHP 8.3 + Apache
Database	MySQL 8.0
Storage	Kubernetes PersistentVolume / PersistentVolumeClaim
Monitoring	Prometheus
Visualization	Grafana
Cloud Platform	AWS
Application

The PHP application displays:

Application name
CI/CD build number
Database connection status
MySQL database name
MySQL Kubernetes Service hostname
CI/CD Pipeline

The Jenkins pipeline performs the following stages:

Checkout source code from GitHub
Build Docker image
Tag image with the Jenkins build number
Authenticate with Amazon ECR
Push Docker image to ECR
Test Kubernetes connectivity
Validate Helm chart
Deploy application using Helm
Wait for Kubernetes resources to become ready

Example image tag:

php-3tier-cicd:15
Kubernetes Components

The Helm chart deploys:

PHP Deployment
PHP NodePort Service
MySQL Deployment
MySQL ClusterIP Service
MySQL Secret
MySQL ConfigMap
MySQL PersistentVolumeClaim
ECR image pull secret

The application is deployed in the capstone namespace.

Database

MySQL runs as a Kubernetes Deployment and uses persistent storage through a PersistentVolume and PersistentVolumeClaim.

The PHP application connects to MySQL using Kubernetes environment variables:

DB_HOST
DB_NAME
DB_USER
DB_PASSWORD
Monitoring

Prometheus and Grafana are deployed in the monitoring namespace.

Monitoring includes:

Kubernetes node CPU usage
Kubernetes node memory usage
PHP pod CPU usage
PHP pod memory usage
MySQL pod CPU usage
MySQL pod memory usage
Validation

The final deployment was successfully validated with:

PHP 3-Tier CI/CD Application
CI/CD Version: Build 15
Database Status: Connected Successfully
MySQL database: phpapp
MySQL host: mysql

The Jenkins pipeline completed successfully with the Docker image pushed to Amazon ECR and the Helm release deployed to Kubernetes.

Project Status

Status: Successfully deployed and validated

Jenkins Build: 15

Helm Release: php-3tier-cicd

Kubernetes Namespace: capstone
