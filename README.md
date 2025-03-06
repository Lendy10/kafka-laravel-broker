Here’s the updated **GitHub-formatted** `README.md` file with **Step 5 (Connecting Kafka UI to Kafka) moved to the last step**:

---

```md
# High Availability Kafka Cluster in Kubernetes

This repository contains a step-by-step guide to provision a **Highly Available (HA) Kafka Cluster** inside **Kubernetes**, using **KIND (Kubernetes in Docker)** for local experimentation. The setup includes **Kafka UI for monitoring** and management.

## 🚀 Overview

Kafka is widely used for event-driven architecture, but setting it up in Kubernetes requires careful planning. This guide will cover:

✅ **Installing KIND for Kubernetes in Docker**  
✅ **Creating a Kubernetes cluster for Kafka**  
✅ **Deploying Kafka as a StatefulSet with Helm**  
✅ **Installing Kafka UI for monitoring**  
✅ **Port-forwarding Kafka UI for access**  
✅ **Retrieving Kafka SASL authentication credentials**  
✅ **Connecting Kafka UI to the Kafka cluster**  

---

## 🛠 Prerequisites

Before you start, ensure you have the following installed:

- [Docker](https://docs.docker.com/get-docker/)  
- [KIND (Kubernetes in Docker)](https://kind.sigs.k8s.io/docs/user/quick-start/)  
- [Helm Package Manager](https://helm.sh/docs/intro/install/)  

---

## 🏗 Step 1: Install KIND and Create Kubernetes Cluster

We will use **KIND** to set up a local Kubernetes cluster. Run the following command to create a cluster using the predefined configuration:

```sh
kind create cluster --config node-deployment.yaml
```

This command initializes a multi-node Kubernetes cluster based on the specifications defined in `node-deployment.yaml`.

---

## 📂 Step 2: Create a New Namespace for Kafka

To keep Kafka resources isolated and organized, create a dedicated namespace:

```sh
kubectl create namespace kafka
```

This ensures that all Kafka-related resources are deployed in the `kafka` namespace.

---

## 📦 Step 3: Install Kafka using Helm

Kafka requires **persistent storage and proper resource allocation**. We will install Kafka using the **Bitnami Helm Chart** with a custom values file:

```sh
helm install kafka bitnami/kafka --namespace kafka --values kafka-broker-values.yaml
```

The custom values file **configures**:

- **Storage class & PVC size** – Ensures persistence for Kafka brokers.  
- **Replication & partitions for HA** – Helps prevent message loss in case of failure.  
- **Networking configurations** – Allows internal communication within the cluster.  

> ⚠️ **Ensure your cluster has a storage provisioner installed.** In this setup, we use `rancher.io/local-path`.

---

## 🖥 Step 4: Install Kafka UI for Management

Kafka UI makes it easier to **monitor brokers, topics, and consumers**.

```sh
helm repo add kafka-ui https://provectus.github.io/kafka-ui
helm install kafka-ui kafka-ui/kafka-ui --namespace kafka --values kafka-values.yaml
```

The **custom values file** in this repository ensures:
- **Proper authentication settings**  
- **Integration with our Kafka cluster**  
- **Enhanced monitoring features**  

---

## 🌍 Step 5: Port-forward Kafka UI to Access It Locally

Before accessing Kafka UI, we need to **port-forward the service** so it’s reachable from our local machine.

Run the following command to expose Kafka UI on **port 8080**:

```sh
kubectl port-forward svc/kafka-ui 8080:80 -n kafka
```

Now, **Kafka UI is accessible via**:

🔗 **http://localhost:8080**

---

## 🔑 Step 6: Retrieve Kafka SASL Authentication Credentials

If Kafka is deployed with **SASL authentication enabled**, you’ll need the credentials to connect.

Run the following command to get the Kafka authentication secret:

```sh
kubectl get secret kafka -n kafka -o yaml
```

Inside the output, you’ll find **username and password fields** (Base64 encoded). Decode them using:

```sh
echo "<base64_encoded_value>" | base64 --decode
```

This will give you the **actual Kafka SASL credentials** needed for authentication.

---

## 🔗 Step 7: Connect Kafka UI to Kafka

1. Open **Kafka UI** in your browser at **http://localhost:8080**.  
2. Click **"Configure New Cluster"**.  
3. Set the following fields:
   - **Service Name**: The service name from Kafka Helm deployment.  
   - **Port**: Use the Kafka service port.  
   - **Authentication**: Use the Kafka SASL credentials retrieved in Step 6.  
4. Click **Save**, and Kafka UI will be connected to the Kafka cluster. 🎉  

---

## 🎯 What’s Next?

With Kafka installed, the next steps in this experiment will cover:

- **How Kafka ensures HA with topic partitions & consumer groups**  
- **Integrating Laravel 12 with Kafka for real-time processing**  
- **Benchmarking Kafka vs RabbitMQ in an event-driven architecture**  

Stay tuned for updates! 🚀  

---

## 🤝 Contributing

If you have improvements or suggestions, feel free to open an issue or submit a PR.

## 📜 License

This project is licensed under the **MIT License**.

---

🔥 **Have questions? Want to discuss Kafka vs RabbitMQ? Drop an issue or comment!** 🚀
```

---

### **📥 How to Use This**
1. Save this file as **`README.md`** in your GitHub repository.
2. It will automatically render with GitHub markdown formatting.
3. Your contributors and readers will have a clean, structured guide to follow.  

Now the **Kafka UI connection step is at the last part**, as you requested. Let me know if you need any further refinements! 🚀