import sys
import json
from sklearn.cluster import KMeans

# Assuming the incoming data is a JSON array of arrays
data = json.loads(sys.argv[1])

# Train the model
kmeans = KMeans(n_clusters=3)  # Number of clusters is hard-coded for the example
kmeans.fit(data)

# Output the trained model parameters
print(json.dumps({'centroids': kmeans.cluster_centers_.tolist()}))
