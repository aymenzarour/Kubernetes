# K3s Deployment for Web App with HostPath Volume

This repository contains the configuration files for a simple web application deployment using Kubernetes on a K3s cluster. The application utilizes a hostPath volume to persist data outside the container's lifecycle.



## Steps

1. Create the namespace:
```bash
$ kubectl apply -f webapp-ns.yaml
```
This creates a namespace named webapp to isolate resources associated with this application.

2. Deploy the web application:
```bash
$ kubectl apply -f webapp-deploy.yaml
```
This deploys a deployment named webapp-deploy with the following configurations:

- Creates three replicas of the Nginx container (image: nginx:latest).
- Mounts a hostPath volume named myhostpathvolume at the /usr/share/nginx/html directory within the container. This directory can be used to store any data you want to persist, such as web page content.

3. Create the service:
```bash
$ kubectl apply -f webapp-svc.yaml
```
This defines a 'ClusterIP' service named webapp-pod that exposes the deployed pods on port 8080 within the cluster.

4. Create the ingress:
```bash
$ kubectl apply -f webapp-ingress.yaml
```
This creates an Ingress resource named webapp-ingress with the following configuration:
- Maps the hostname web.local.com to the service webapp-pod's port 8080.
- Requires you to configure DNS (e.g., /etc/hosts) to point web.local.com to your K3s cluster's IP address.

## Verifying the Deployment

1. View pod status:
```bash
$ kubectl get pods -n webapp

NAME                            READY   STATUS    RESTARTS   AGE
webapp-deploy-b8c67f846-h6bs9   1/1     Running   0          145m
webapp-deploy-b8c67f846-7vpnv   1/1     Running   0          145m
webapp-deploy-b8c67f846-hm4mv   1/1     Running   0          145m

```
You should see three pods in the Running state named webapp-deploy-<pod_hash>.

2. Check service details:
```bash
$ kubectl get svc -n webapp

NAME         TYPE        CLUSTER-IP     EXTERNAL-IP   PORT(S)    AGE
webapp-pod   ClusterIP   10.43.116.87   <none>        8080/TCP   146m

```
This outputs information about the service, including its internal cluster IP address and the exposed port.

3. Access the web application (if using ingress):
```bash
$ kubectl get ingress -n webapp

NAME             CLASS     HOSTS           ADDRESS          PORTS   AGE
webapp-ingress   traefik   web.local.com   192.168.43.140   80      135m
```
- Open a web browser and navigate to http://web.local.com :

```bash
$ curl web.local.com
Bonjour depuis le noeud Master, by aymen
```
this content is the html code placed in the directory /myhostpath/ which will be mounted to my webapp containers/pods


## Explanation of Kubernetes Volumes and HostPath Type:
1. Kubernetes Volumes: Volumes provide a mechanism to store and manage persistent data for containerized applications. They offer abstraction from the underlying storage implementation, enabling data persistence and sharing across containers.
2. HostPath Volume Type: The hostPath volume type mounts a directory from the host system (the K3s node) into the container as a volume. This is useful for persisting data that needs to be shared between container restarts or across different deployments.

- note:  The hostPath type should be used with caution in production environments due to potential security risks. Ensure the host directory has appropriate access permissions to prevent unauthorized access or write operations.
