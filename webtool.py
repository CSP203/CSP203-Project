from flask import Flask,redirect
import dlib
import cv2
import sys
import os
import errno
import glob
import math
import numpy as np
from numpy import linalg as LA
from skimage import io

app = Flask(__name__)
 
@app.route("/markface")
def markface(course_instructor):
	detector = dlib.get_frontal_face_detector()
	img = io.imread("/var/www/flask-prod/" + course_instructor)  # path where image is stored by android
	dets = detector(img, 1)
	for i, d in enumerate(dets):
		cv2.rectangle(img, (d.left(), d.top()), (d.right(), d.bottom()), (255, 0, 0), 2)
	img = img[:,:,::-1]
	cv2.imwrite("/var/www/html/csp203/red_marked/output.jpg", img)
	folder_name = course_instructor.split('.')[0]
	path = folder_name + '/*.txt'
	files = glob.glob(path)
	list_f = []
	for name in files:
		try:
		    with open(name) as f:
		    	data = f.read()
		    	list_f.add(data)
		        
		except IOError as exc:
		    if exc.errno != errno.EISDIR:
		        raise

	for k, d in enumerate(dets):
		shape = sp(in_image, d)
		face_descriptor = facerec.compute_face_descriptor(in_image, shape)
		list1.append(face_descriptor)

	label = -1
	output = []
	for f in range(0,len(list1)):
		y = 10000000
		label = -1
		for g in range(0,len(list_f)):
			loss = np.subtract(list1[f],list2[g])
			x = LA.norm(loss)
			if(x<y):
				y = x;
				label = g;
	
		if(label!=-1):
			if(y<0.5):
				output.add(list3[label])
	out_file = open("/var/www/html/csp203/red_marked/ppl_found.txt")
	out_file.write(output)
	return "done"


@app.route("/storeF/<entryNum>")
def storeF(entryNum):
	predictor_path = "shape_predictor_5_face_landmarks.dat"
	face_rec_model_path = "dlib_face_recognition_resnet_model_v1.dat"
	detector = dlib.get_frontal_face_detector()
	sp = dlib.shape_predictor(predictor_path)
	facerec = dlib.face_recognition_model_v1(face_rec_model_path)
	dbfaces_folder_path = "/var/www/html/csp203/student_images/" +  entryNum 
	files_grabbed = []
	types = ["*.png" , "*.jpeg" , "*.jpg"]
	co = 0
	count = 0
	list3 = []
	list2 = []
	for g in glob.glob(os.path.join(dbfaces_folder_path, "*.jpg")):
		count += 1
		img1 = io.imread(g)
		dets1 = detector(img1, 1)
		if(len(dets1)!=1):
			print("Error: Image Labels are ambiguous")
			exit()
		
		list3.append(g)
		for k, d in enumerate(dets1):
			count += 1
			shape = sp(img1, d)
			face_descriptor = facerec.compute_face_descriptor(img1, shape)
			list2.append(face_descriptor)
			g = g.replace(".jpeg" , ".txt")
			g = g.replace(".png" , ".txt")
			g = g.replace(".jpg" , ".txt")
			f = open( g , "a+")
			f.write(str(face_descriptor))
	return str(count)
	


if __name__ == "__main__":
    app.run(debug=True)
    
    
    

