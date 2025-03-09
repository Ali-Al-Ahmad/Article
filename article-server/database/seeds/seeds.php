<?php
$questions = [
  ["question" => "What is a Reference Architecture?", "answer" => "A Reference Architecture is a predefined template or set of patterns used in specific technical and business contexts. It serves as a reusable framework capturing best practices for designing system architectures."],
  ["question" => "How does Reference Architecture differ from general architecture?", "answer" => "Many architects use the term Reference Architecture differently, focusing on various aspects such as value, visualization, and application, leading to a lack of a unified definition."],
  ["question" => "Why is there no common definition of Reference Architecture among architects?", "answer" => "Many architects use the term Reference Architecture differently, focusing on various aspects such as value, visualization, and application, leading to a lack of a unified definition."],
  ["question" => "What is the primary purpose of Reference Architecture?", "answer" => "The primary purpose is to provide guidance for future developments by establishing a shared baseline of why, what, and how systems should be designed and developed."],
  ["question" => "What are the key components of a well-designed Reference Architecture?", "answer" => "A well-designed Reference Architecture includes: Technical Architecture (system design patterns, functional components, technical constraints), Business Architecture (strategic goals, economic considerations, market needs), Customer Context (user requirements, domain challenges, regulatory standards)"],
  ["question" => "How does Reference Architecture improve efficiency?", "answer" => "By reducing development time and costs, leveraging proven solutions, and providing a shared framework that simplifies design and implementation."],
  ["question" => "In what way does Reference Architecture reduce risks?", "answer" => "It minimizes risks by using validated architectural elements, which improve reliability, reduce errors, and enhance security."],
  ["question" => "Why is interoperability an important benefit of Reference Architectures?", "answer" => "Ensuring that different systems can work together effectively allows for seamless integration, reducing conflicts between technologies and business processes."],
  ["question" => "How does Reference Architecture contribute to competitive advantage?", "answer" => "Organizations that use Reference Architectures can innovate faster, respond more quickly to market demands, and align their systems with business strategies efficiently."],
  ["question" => "How is Reference Architecture currently used across industries?", "answer" => "Different industries use Reference Architectures in varied ways, with some focusing on technology implementation while others emphasize business objectives and interoperability."],
  ["question" => "Which companies or organizations have developed their own Reference Architectures?", "answer" => "Companies like Sun Microsystems, BEA Systems, and various government agencies have developed their own tailored Reference Architectures to address specific challenges."],
  ["question" => "Why do different organizations define Reference Architectures differently?", "answer" => "Because organizations have unique goals, technologies, and market conditions, they tailor Reference Architectures to meet their specific needs and strategies."],
  ["question" => "What are the main driving forces behind the use of Reference Architectures?", "answer" => "Managing synergy and best practices, Reducing redundancy in system development, Ensuring interoperability among systems, Aligning architecture with business strategies and customer needs"],
  ["question" => "Why is it important to continuously update Reference Architectures?", "answer" => "To reflect technological advancements, changing business requirements, and emerging best practices, ensuring they remain relevant and useful."],
  ["question" => "How can organizations capture both explicit and implicit knowledge in Reference Architectures?", "answer" => "By documenting best practices, experiences, and lessons learned while also encouraging collaboration to share experience-based, undocumented knowledge."],
  ["question" => "What role do design patterns play in Reference Architectures?", "answer" => "Design patterns provide reusable, proven solutions for common problems, helping standardize system design and implementation."],
  ["question" => "What is the challenge of balancing stability and innovation in Reference Architectures?", "answer" => "Organizations must maintain stable foundational architectures while incorporating innovative solutions to stay competitive and adaptable to change."],
  ["question" => "What are the main challenges in defining Reference Architectures?", "answer" => "Lack of standardized definitions, Uncertainty in whether they should primarily serve business strategists, architects, or engineers, Difficulty in quantifying their effectiveness"],
  ["question" => "Why is it necessary to develop quantitative measures for assessing Reference Architectures?", "answer" => "Quantitative measures help in understanding their impact on efficiency, cost reduction, and business success, enabling better decision-making."],
  ["question" => "What are the key areas for future research in Reference Architectures?", "answer" => "Refining definitions and structures, Establishing clearer roles and applications, Developing better methods for managing and evolving Reference Architectures"]
];

foreach ($questions as $question) {
  $found = $conn->prepare("SELECT id FROM questions WHERE question = ?");
  $ques = $question['question'];
  $found->bind_param("s", $ques);
  $found->execute();
  $result = $found->get_result();

  if ($result->num_rows > 0) {

    continue;
  } else {

    $ans = $question['answer'];
    $query = $conn->prepare("INSERT INTO questions (question, answer) VALUES (?, ?)");
    $query->bind_param("ss", $ques, $ans);

    if (!$query->execute()) {
      echo "Error adding question" . $conn->error . "\n";
    }
  }
}
