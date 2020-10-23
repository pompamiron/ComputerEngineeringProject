#!/usr/bin/env python
# coding: utf-8

# https://stackabuse.com/decision-trees-in-python-with-scikit-learn/

# In[2]:


import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
get_ipython().run_line_magic('matplotlib', 'inline')


# In[3]:


dataset = pd.read_csv('รวมไม่มีเอม.csv', index_col=0)


# In[4]:


dataset.shape


# In[5]:


dataset.tail()


# In[6]:


X = dataset.drop('Label', axis=1)
y = dataset['Label']


# In[7]:


from sklearn.model_selection import train_test_split
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3)

#test30%train70%


# In[8]:


from sklearn.tree import DecisionTreeClassifier
classifier = DecisionTreeClassifier()
classifier.fit(X_train, y_train)


# In[15]:


y_pred = classifier.predict(X_test)


# In[16]:


X_train


# In[17]:


from sklearn.metrics import classification_report, confusion_matrix
print(confusion_matrix(y_test, y_pred))
print(classification_report(y_test, y_pred))


# In[18]:


print(classifier.feature_importances_) #use inbuilt class feature_importances of tree based classifiers

#plot graph of feature importances for better visualization
feat_importances = pd.Series(classifier.feature_importances_, index=X.columns)
feat_importances.nlargest(20).plot(kind='barh')
plt.show()


# In[19]:


#from sklearn.tree.export import export_txt
from sklearn.tree import export_text

tree_rules = export_text(classifier, feature_names=list(X_train))
print(tree_rules)


# In[ ]:





# In[ ]:




