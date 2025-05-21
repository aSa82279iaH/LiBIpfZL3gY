from utils import color, gclassroom, logger

Classroom = gclassroom.Classroom()
Color = color.Color()
Logger = logger.Logger()


def help():
    Logger.notice("classroom-cli v0.0.1:")
    print("h (help) | Displays this menu\nlc (listcourses) | Lists courses that you are enrolled in\nla (listassignments) | Lists assignments that are due to be turned in\nexit (stop, x) | Closes the application")


def menu():
    parseCommand(input(Color.BLUE + "> " + Color.END))


def parseCommand(command):
    if command in ("h", "help"):
        help()
        ClassroomHelper.listCourses()
    elif command in ("la", "listassignments"):
        ClassroomHelper.listAssignmentsBatch()
        exit(0)
    else:
        Logger.error("Unknown command!")

    menu()

if __name__ == '__main__':
    Classroom.initialize()

    student = Classroom.service.userProfiles().get(userId="me").execute()
    name = student.get("name").get("fullName")

    Logger.success(Color.BOLD + "You are logged in as " + name)
    Logger.info("Type a command or use 'h' or 'help' for help")

    menu()
