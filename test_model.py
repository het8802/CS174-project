import sys
import json
import numpy as np
from sklearn.cluster import KMeans

# Load test data and centroids
data = json.loads(sys.argv[1])
centroids = json.loads(sys.argv[2])  # centroids passed as a second argument

# Initialize KMeans with pre-trained centroids
kmeans = KMeans(n_clusters=len(centroids), n_init=1)
kmeans.fit(centroids)   #fitting the model on centroids

# Predict the cluster for the data
predictions = kmeans.predict(data)

# Output the predictions
print(json.dumps({'Clusters': predictions.tolist()}))
