import sys
import json
from sklearn.cluster import KMeans

# Assuming the incoming data is a JSON array of arrays
data = json.loads(sys.argv[1])

# Here we should load the model and then predict, but for the sake of example,
# we will just instantiate a new model
kmeans = KMeans(n_clusters=3)  # Number of clusters is hard-coded for the example
predictions = kmeans.fit_predict(data)

# Output the predictions
print(json.dumps(predictions.tolist()))
