#!/usr/bin/env python
# coding: utf-8

# # Eat

# In[1]:


import pandas as pd
eat = pd.read_csv('กิน.csv', index_col=0)
eat


# In[2]:


from sklearn.preprocessing import MinMaxScaler
mms = MinMaxScaler()
eat_scaled = pd.DataFrame(mms.fit_transform(eat), 
                         columns=eat.columns, 
                         index=eat.index)
eat_scaled


# In[3]:


eat_scaled.to_csv('eat_scaled.csv')


# In[4]:


from sklearn.cluster import KMeans
cls = KMeans(n_clusters=2, n_jobs=-1)
cls.fit(eat_scaled)


# In[6]:


centroid = pd.DataFrame(cls.cluster_centers_, columns=eat.columns)

import seaborn as sns
sns.heatmap(centroid)

print(centroid)
centroid.to_csv('eat_centroid.csv')


# In[17]:


x1 = eat
x1['eat'] = cls.predict(eat_scaled)
x1['eat']
#y.to_csv('eat_cluster.csv')


# # Sleep

# In[34]:


import pandas as pd
sleep = pd.read_csv('นอน2.csv', index_col=0)
sleep.head()


# In[35]:


from sklearn.preprocessing import MinMaxScaler
mms2 = MinMaxScaler()
sleep_scaled = pd.DataFrame(mms2.fit_transform(sleep), 
                         columns=sleep.columns, 
                         index=sleep.index)
sleep_scaled


# In[20]:


sleep_scaled.to_csv('sleep_scaled.csv')


# In[36]:


from sklearn.cluster import KMeans
cls = KMeans(n_clusters=2, n_jobs=-1)
cls.fit(sleep_scaled)


# In[37]:


centroid = pd.DataFrame(cls.cluster_centers_, columns=sleep.columns)

import seaborn as sns
sns.heatmap(centroid)

print(centroid)
centroid.to_csv('sleep_centroid.csv')


# In[38]:


x2 = sleep
x2['sleep'] = cls.predict(sleep_scaled)
x2['sleep']
x2.to_csv('sleep_cluster.csv')


# # รวม

# In[42]:


import pandas as pd
test = pd.read_csv('รวม.csv', index_col=0)
test.head()


# In[43]:


from sklearn.preprocessing import MinMaxScaler
mms = MinMaxScaler()
test_scaled = pd.DataFrame(mms.fit_transform(test), 
                         columns=test.columns, 
                         index=test.index)
test_scaled


# In[44]:


test_scaled.to_csv('test_scaled.csv')


# In[45]:


from sklearn.cluster import KMeans
cls = KMeans(n_clusters=2, n_jobs=-1)
cls.fit(test_scaled)


# In[46]:


centroid = pd.DataFrame(cls.cluster_centers_, columns=test.columns)

import seaborn as sns
sns.heatmap(centroid)

print(centroid)
centroid.to_csv('test_centroid.csv')


# In[48]:


x = test
x['test'] = cls.predict(test_scaled)
x['test']
#x.to_csv('test_cluster.csv')


# In[ ]:




