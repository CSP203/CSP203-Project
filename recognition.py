import dlib
import sys
import os
import glob
import math
import numpy as np
from numpy import linalg as LA
from skimage import io

predictor_path = sys.argv[1]
face_rec_model_path = sys.argv[2]
input_image = sys.argv[3]
dbfaces_folder_path = sys.argv[4]

detector = dlib.get_frontal_face_detector()
sp = dlib.shape_predictor(predictor_path)
facerec = dlib.face_recognition_model_v1(face_rec_model_path)

list1 = []
list2 = []
list3 = []


img1 = io.imread(input_image)

dets1 = detector(img1, 1)
print("Number of faces detected: {}".format(len(dets1)))

for k, d in enumerate(dets1):
    shape = sp(img1, d)
    face_descriptor = facerec.compute_face_descriptor(img1, shape)
    list1.append(face_descriptor)

        
count1 = 0;
for g in glob.glob(os.path.join(dbfaces_folder_path, "*.jpeg")):
    print("Processing file: {}".format(g))
    img2 = io.imread(g)
    
    dets2 = detector(img2, 1)
    print("Number of faces detected: {}".format(len(dets2)))
    
    if(len(dets2)!=1):
    	print("Error: Image Labels are ambiguous")
    	exit()
    
    list3.append(g)
    count1 = count1+1
    for k, d in enumerate(dets2):
        shape = sp(img2, d)
        face_descriptor = facerec.compute_face_descriptor(img2, shape)
        list2.append(face_descriptor)

count2=0
for g in glob.glob(os.path.join(dbfaces_folder_path, "*.png")):
    print("Processing file: {}".format(g))
    img2 = io.imread(g)
    
    dets2 = detector(img2, 1)
    print("Number of faces detected: {}".format(len(dets2)))
    
    if(len(dets2)!=1):
    	print("Error: Image Labels are ambiguous")
    	exit()
    
    list3.append(g)
    count2 = count2+1
    for k, d in enumerate(dets2):
        shape = sp(img2, d)
        face_descriptor = facerec.compute_face_descriptor(img2, shape)
        list2.append(face_descriptor)

count3=0
for g in glob.glob(os.path.join(dbfaces_folder_path, "*.jpg")):
    print("Processing file: {}".format(g))
    img2 = io.imread(g)
    
    dets2 = detector(img2, 1)
    print("Number of faces detected: {}".format(len(dets2)))
    
    if(len(dets2)!=1):
    	print("Error: Image Labels are ambiguous")
    	exit()
    
    list3.append(g)
    count3 = count3+1
    for k, d in enumerate(dets2):
        shape = sp(img2, d)
        face_descriptor = facerec.compute_face_descriptor(img2, shape)
        list2.append(face_descriptor)
        


label = -1
output = []
print(list3)
print("NUMBER OF JPEG IMAGES ARE *************" + len(count1))
print("NUMBER OF PNG IMAGES ARE *************" + len(count2))
print("NUMBER OF JPG IMAGES ARE *************" + len(count3))
print(len(list1))
print(len(list2))

for f in range(0,len(list1)):
	y = 10000000
	label = -1
	for g in range(0,len(list2)):
		#loss = np.multiply(list1[f] , math.log10(list2[g])) + np.multiply(1-list1[f] , math.log10(1-list2[g]))
		loss = np.subtract(list1[f],list2[g])
		x = LA.norm(loss)
		if(x<y):
			y = x;
			label = g;
	
	if(label!=-1):
		if(y<0.5):
			print( list3[label] )
			#print( label )
			
