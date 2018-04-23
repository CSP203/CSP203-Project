import dlib
import sys
import os
import glob
import math
import numpy as np
from numpy import linalg as LA
from skimage import io

predictor_path = "shape_predictor_5_face_landmarks.dat"
face_rec_model_path = "dlib_face_recognition_resnet_model_v1.dat"
input_image = sys.argv[1]
dbfaces_folder_path = sys.argv[2]

detector = dlib.get_frontal_face_detector()
sp = dlib.shape_predictor(predictor_path)
facerec = dlib.face_recognition_model_v1(face_rec_model_path)

list1 = []
list2 = []
list3 = []


in_image = io.imread(input_image);
dets = detector(in_image , 1)
print("Number of faces detected: {}".format(len(dets)))
for k, d in enumerate(dets):
    shape = sp(in_image, d)
    face_descriptor = facerec.compute_face_descriptor(in_image, shape)
    list1.append(face_descriptor)
        


for g in glob.glob(os.path.join(dbfaces_folder_path, "*.jpeg")):
    print("Processing file: {}".format(g))
    img1 = io.imread(g)
    
    dets1 = detector(img1, 1)
    print("Number of faces detected: {}".format(len(dets1)))
    
    if(len(dets1)!=1):
    	print("Error: Image Labels are ambiguous")
    	exit()
    
    list3.append(g)
    for k, d in enumerate(dets2):
        shape = sp(img1, d)
        face_descriptor = facerec.compute_face_descriptor(img1, shape)
        list2.append(face_descriptor)
        g = g.replace(".jpeg" , ".txt")
        f = open( g , "a+")
        f.write(str(face_descriptor))
        
        

for g in glob.glob(os.path.join(dbfaces_folder_path, "*.png")):
    print("Processing file: {}".format(g))
    img2 = io.imread(g)
    dets2 = detector(img2, 1)
    print("Number of faces detected: {}".format(len(dets2)))
    
    if(len(dets2)!=1):
    	print("Error: Image Labels are ambiguous")
    	exit()
    
    list3.append(g)
    for k, d in enumerate(dets2):
        shape = sp(img2, d)
        face_descriptor = facerec.compute_face_descriptor(img2, shape)
        list2.append(face_descriptor)
        g = g.replace(".png" , ".txt")
        f = open( g , "a+")
        f.write(str(face_descriptor))


for g in glob.glob(os.path.join(dbfaces_folder_path, "*.jpg")):
    print("Processing file: {}".format(g))
    img2 = io.imread(g)
    
    dets2 = detector(img2, 1)
    print("Number of faces detected: {}".format(len(dets2)))
    
    if(len(dets2)!=1):
    	print("Error: Image Labels are ambiguous")
    	exit()
    
    list3.append(g)
    for k, d in enumerate(dets2):
        shape = sp(img2, d)
        face_descriptor = facerec.compute_face_descriptor(img2, shape)
        list2.append(face_descriptor)
        g = g.replace(".jpg" , ".txt")
        f = open( g , "a+")
        f.write(str(face_descriptor))
