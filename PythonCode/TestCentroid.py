#!/usr/bin/env python
# coding: utf-8

# In[1]:


get_ipython().run_line_magic('matplotlib', 'inline')
from copy import deepcopy
import numpy as np
import pandas as pd
from matplotlib import pyplot as plt
plt.rcParams['figure.figsize'] = (16, 9)
plt.style.use('ggplot')


# In[11]:


# Importing the dataset
data = pd.read_csv('write_result.csv')
data


# In[14]:


# Getting the values and plotting it
f1 = data['Test'].values
f2 = data.values
X = np.array(list(zip(f1, f2)))
plt.scatter(f1, f2, c='black', s=7)


# In[ ]:




