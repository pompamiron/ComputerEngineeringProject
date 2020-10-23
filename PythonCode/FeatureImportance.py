#!/usr/bin/env python
# coding: utf-8

# In[5]:


import pandas as pd
import numpy as np
data = pd.read_csv('test_tree.csv', index_col=0)
X = data.iloc[:,0:12]  #independent columns
y = data.iloc[:,-1]    #target column i.e price range

from sklearn.ensemble import ExtraTreesClassifier
import matplotlib.pyplot as plt

model = ExtraTreesClassifier()
model.fit(X,y)
print(model.feature_importances_) #use inbuilt class feature_importances of tree based classifiers

#plot graph of feature importances for better visualization
feat_importances = pd.Series(model.feature_importances_, index=X.columns)
feat_importances.nlargest(15).plot(kind='barh')
plt.show()


# In[ ]:




