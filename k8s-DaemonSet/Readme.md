# Apache DaemonSet Project

This project demonstrates the use of a Kubernetes DaemonSet to deploy Apache servers on each node in the cluster. The DaemonSet ensures that an instance of the Apache server runs on nodes with specific labels, utilizing specified resource limits and persistent storage.

## DaemonSet Utility and Definition

### DaemonSet
A DaemonSet in Kubernetes ensures that a copy of a pod runs on each node in the cluster. It is useful for deploying system-level daemons or monitoring agents on every node.

### DaemonSet Definition
The DaemonSet definition file (`apache-daemonset.yaml`) in this project configures the deployment of Apache servers as DaemonSet pods. It includes specifications for container images, resource limits, and persistent storage.

## Project Setup Steps

1. **Prepare HTML File:**
   - Create an HTML file (e.g., `index.html`).
   - Add content to the HTML file, including the name "Aymen."

2. **Copy HTML File to Host Machine:**
   - Copy the HTML file to the host machine at `/tmp/apache`.

3. **Update DaemonSet YAML:**
   - Ensure the HTML file is available on the host machine.
   - Update the `apache-daemonset.yaml` file with correct image, resource limits, and volume mounts.

4. **Deploy DaemonSet:**
   - Save the updated YAML file.
   - Deploy the DaemonSet using the following command:
     ```bash
     kubectl apply -f apache-daemonset.yaml
     ```

5. **Verify Deployment:**
   - Check the status of the DaemonSet pods:
     ```bash
     kubectl get pods
     ```
   - Ensure that each node has an Apache pod running.

6. **Access Apache Server:**
   - Use the node's IP and Apache's service port to access the HTML content served by Apache.

Feel free to customize the project as needed and explore further Kubernetes concepts such as labels, resource management, and persistent storage.
