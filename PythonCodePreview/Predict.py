#!/usr/bin/env python
# coding: utf-8

# In[1]:


import pandas as pd
G1 = pd.read_csv('FeatureG1.csv', index_col=0)
G1


# In[2]:


from sklearn.preprocessing import MinMaxScaler
mms = MinMaxScaler()
G1_scaled = pd.DataFrame(mms.fit_transform(G1), 
                         columns=G1.columns, 
                         index=G1.index)
G1_scaled


# In[3]:


from sklearn.cluster import KMeans
cls = KMeans(n_clusters=2, n_jobs=-1)
cls.fit(G1_scaled)


# In[4]:


centroid = pd.DataFrame(cls.cluster_centers_, columns=G1.columns)

import seaborn as sns
sns.heatmap(centroid)

print(centroid)


# In[5]:


x = G1
x['G1'] = cls.predict(G1_scaled)
x['G1']


# In[6]:


G2 = pd.read_csv('FeatureG2.csv', index_col=0)
G2


# In[7]:


from sklearn.preprocessing import MinMaxScaler
mms = MinMaxScaler()
G2_scaled = pd.DataFrame(mms.fit_transform(G2), 
                         columns=G2.columns, 
                         index=G2.index)
G2_scaled


# In[8]:


x = G2
x['G2'] = cls.predict(G2_scaled)
x['G2']





