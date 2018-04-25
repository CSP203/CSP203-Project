import sys
import cv2
import dlib
from skimage import io

detector = dlib.get_frontal_face_detector()
win = dlib.image_window()

for f in sys.argv[1:]:
    img = io.imread(f)
    dets = detector(img, 1)
    for i, d in enumerate(dets):
        cv2.rectangle(img, (d.left(), d.top()), (d.right(), d.bottom()), (255, 0, 0), 2)
    img = img[:,:,::-1]
    cv2.imwrite("a.png", img)
