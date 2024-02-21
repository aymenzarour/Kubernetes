# Kubernetes Web Application with MySQL Database

This project demonstrates the deployment of a simple web application using PHP and Apache, connected to a MySQL database. The web application displays a list of cities stored in the MySQL database.

## Project Structure

- `php-dockerfile`: Dockerfile for building the PHP and Apache container image.
- `index.php`: PHP source code for the web application.
- `front-deployment.yaml`: Kubernetes Deployment configuration for the web application.
- `front-svc.yaml`: Kubernetes Service configuration for the web application.
- `init.sql`: SQL script for initializing the MySQL database.
- `mysql-deployment.yaml`: Kubernetes Deployment configuration for the MySQL database.
- `mysql-svc.yaml`: Kubernetes Service configuration for the MySQL database.

## Project Description

This project aims to showcase a simple Kubernetes deployment consisting of a web application and a MySQL database. The web application interacts with the MySQL database to display a list of cities.

### MySQL Service Configuration

The MySQL service (`mysql-svc.yaml`) is configured as a ClusterIP service. This choice is made because external access to the database is not required. The web application and the database are part of the same Kubernetes cluster, making internal communication sufficient for their interaction. This approach enhances security by restricting database access within the cluster.

### Web Application Service Configuration

The web application service (`front-svc.yaml`) is configured as a NodePort service. This decision is based on the need to access the web application externally. By exposing the service on a NodePort, the web application becomes accessible from outside the cluster. This setup is suitable for scenarios where external users or services need to interact with the web application.

## Steps to Deploy

1. **Build and push Docker Image for PHP Web Application:**

   ```bash
   docker build -t aymenzarour/php-web:v6 -f php-dockerfile .
   docker push aymenzarour/php-web:v6

2. **Apply MySQL ConfigMap and Deploy MySQL Database:**

   ```bash
   kubectl create configmap mysql-init-script --from-file=init.sql
   kubectl apply -f mysql-svc.yaml
   kubectl apply -f mysql-deployment.yaml
   
3. **Wait for MySQL Deployment to be Ready:**

   ```bash
   kubectl get pods -w
   
*Terminal response:*

   ```text
   NAME                                   READY   STATUS    RESTARTS   AGE
   mysql-deployment-5b55687dff-mq5ln      1/1     Running   0          4h16m
  ```

4. **Apply Frontend Deployment and Service:**

   ```bash
   kubectl apply -f front-deployment.yaml
   kubectl apply -f front-svc.yaml
   
5. **Wait for Frontend Deployment to be Ready:**

   ```bash
   kubectl get pods -w
   
*Terminal response:*

   ```text
   NAME                                   READY   STATUS    RESTARTS   AGE
   mysql-deployment-5b55687dff-mq5ln      1/1     Running   0          4h16m
   frontend-deployment-7d7d8df9d9-dfccj   1/1     Running   0          24m
  ```
   
6. **Access the Web Application:**

- Find the external IP of your Kubernetes node:
   ```bash
   kubectl get nodes -o wide
   
*Terminal response:*

   ```text
   NAME      STATUS   ROLES                  AGE   VERSION        INTERNAL-IP     EXTERNAL-IP   OS-IMAGE             KERNEL-VERSION     CONTAINER-RUNTIME
   ubuntu1   Ready    control-plane,master   32d   v1.28.5+k3s1   192.168.43.96   <none>        Ubuntu 22.04.3 LTS   6.5.0-14-generic   containerd://1.7.11-k3s2
  ```

- Access the web application using the node's IP and the NodePort 32500:
  ```bash
   curl http://192.168.43.96:32500
     
*browser:*

   ```text
   List of Cities
   Connected to MySQL successfully
   - New York
   - Paris
   - Tokyo
   ```

## NOTES:
- The MySQL service is set as ClusterIP since external access is not required.
- The Web Application service is set as NodePort to allow external access using the node's IP and the specified NodePort (32500 in this case).    

