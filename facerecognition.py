import face_recognition
import sys
import cv2

def look_for_face(uri):
  image = face_recognition.load_image_file(uri)
  face_locations = face_recognition.face_locations(image)
  if face_locations:
    print('true')
    img = cv2.imread(uri)
    for face_points in face_locations:
      img = cv2.rectangle(img, (face_points[1], face_points[0]), (face_points[3], face_points[2]), (255, 0, 0), 3)
    cv2.imwrite(uri, img)
  else:
    print('false')
        
look_for_face(sys.argv[1])