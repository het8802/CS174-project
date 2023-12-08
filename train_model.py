import sys
import json
from sklearn.cluster import KMeans

# Assuming the incoming data is a JSON array of arrays
data = json.loads(sys.argv[1])
clusterNumber = json.loads(sys.argv[2])

# Train the model
kmeans = KMeans(n_clusters=int(clusterNumber))  # Number of clusters is hard-coded for time being
kmeans.fit(data)

# Output the trained model parameters
print(json.dumps({'centroids': kmeans.cluster_centers_.tolist()}))
