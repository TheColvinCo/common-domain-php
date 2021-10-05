# Colvin Common Domain 💐 🪴
Colvin Common Domain is a brand-new composer package 📦 where you could find Core objects that could help you. 

## Table of Contents

- [Colvin Common Domain 💐 🪴](#colvin-common-domain------)
    * [Installation ⚒️](#installation-%EF%B8%8F)
    * [Usage 👩‍💻](#usage-)
        + [Application](#application)
        + [Domain 🌼](#domain-)
        + [Infrastructure 🏗️](#infrastructure-%EF%B8%8F)
    * [Contributing 🤝](#contributing-)

## Installation ⚒️

Simply run `composer req colvin/common-domain-php`. Note you have to be at least in PHP 8 (we are modern people, yup).

## Usage 👩‍💻

This package has multiple tools which can be useful. We have taken advantage of the **Hexagonal Architecture** to organise 
it, so we have the three typical folders: **Application, Domain and Infrastructure**:

### Application

Here we will find the two definitions of Command and Query, used in architectures like CQRS. They are just abstract implementations of 
the `ActionMessage` abstract class. We will cover it soon.

### Domain 🌼

Here we'll find the big stuff. We have `Exception`, `Message` and `Model` Folders. 
- Exceptions (surprise 🙀🙀) store exception definitions.
- In `Message` we find the definitions of:
  - ActionMessage (used in queries and commands, they are "actions"). 
  - AggregateMessage. This is the big boy, used to model **Domain Events**.
  - Message. The mother of all. It ensures all messages have the same structure.
- In `Model` we can find different useful Value Objects, and an interesting `AggregateRoot`. This will be used in our future entities, and it has the ability to record Domain Events.
- `DomainEvent`. There is not much to explain here 🦫

### Infrastructure 🏗️

As in every Infrastructure HA folder, here we try to manage the relation with external dependencies. There are useful classes, for example; to serialize and deserialize messages following the JSON Api Standard.

## Contributing 🤝
Pull requests are more than welcome!. For major changes, please open an issue first to discuss what you would like to change.

Please remember to update tests as appropriate.
