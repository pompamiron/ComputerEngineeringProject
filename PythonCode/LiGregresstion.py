#!/usr/bin/env python
# coding: utf-8

# https://medium.com/@anishsingh20/logistic-regression-in-python-423c8d32838b

# In[6]:


import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
get_ipython().run_line_magic('matplotlib', 'inline')

import matplotlib.pyplot as plt
import numpy as np
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import classification_report, confusion_matrix


# In[7]:


dataset = pd.read_csv('รวม.csv', index_col=0)


# In[8]:


dataset.shape


# In[9]:


sns.heatmap(dataset.isnull(),yticklabels=False,cbar=False,cmap='viridis')


# In[10]:


X = dataset.drop('Label', axis=1)
y = dataset['Label']


# In[11]:


from sklearn.model_selection import train_test_split
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3)

#test30%train70%


# In[12]:


from sklearn.linear_model import LogisticRegression
#create an instance and fit the model 
logmodel = LogisticRegression()
logmodel.fit(X_train, y_train)


# In[13]:


#predictions
Predictions = logmodel.predict(X_test)


# In[14]:


from sklearn.metrics import classification_report, confusion_matrix
print(confusion_matrix(y_test, Predictions))

print(classification_report(y_test,Predictions))


# In[ ]:




