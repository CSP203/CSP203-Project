import glob
import errno

path = 's3/*.txt'
files = glob.glob(path)
list_f = []
for name in files:
    try:
        with open(name) as f:
        	data = f.read()
        	list_f.add(data)
            pass # do what you want
    except IOError as exc:
        if exc.errno != errno.EISDIR:
            raise

input_image = sys.argv[1]
in_image = io.imread(input_image);
dets = detector(in_image , 1)
print("Number of faces detected: {}".format(len(dets)))
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
		#loss = np.multiply(list1[f] , math.log10(list2[g])) + np.multiply(1-list1[f] , math.log10(1-list2[g]))
		loss = np.subtract(list1[f],list2[g])
		x = LA.norm(loss)
		if(x<y):
			y = x;
			label = g;
	
	if(label!=-1):
		if(y<0.5):
			print( list3[label] )
